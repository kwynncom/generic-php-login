<?php

require_once('/opt/kwynn/kwutils.php');
require_once(__DIR__ . '/' . 'dao.php');
require_once('charValidator.php');
require_once('password.php');
require_once(__DIR__ . '/' . 'config.php');

/* The following call needs to be there to catch the JavaScript redirects. I'm not sure that "Location" header redirects 
 * will work as a subtitute.  My brief attempt at such failed.   */
 
users::getUName();

class users {
    
    const maxunamel = 50;
    
    public static function getUName() { return self::getUInfo('nameonly'); }

    public static function getUID()   { return self::getUInfo('uid'); }
    
    public static function getUInfo($rtype = false) {
	
	try {
	    $o = new users();
	    $un = $o->isIn();
	    kwas($un, 'login process failed');
	    if ($rtype === 'nameonly') return $un;
	    
	    $dbr = $o->dao->inInfo();
	    if ($rtype === 'uid') return self::validSeqOrDie($dbr['seq']);
	    return $dbr;

	} catch(Exception $ex) {

	    $ro = new stdClass();

	    $code = $ex->getCode();
	    if ($code >= 22000 && $code <= 22999) {
		$ro->id = 'uname';
		$ro->invalid = true;
	    }

	    $ro->msg = $ex->getMessage();
	    kwjae($ro);
	}
    }
    
    // because I'm feeling paranoid
    private static function validSeqOrDie($sin) {
	kwas($sin && is_integer($sin) && $sin >= 1, 'bad seq');
	return $sin;
    }

    public static function getMyURL() {
       
	$u  = '';  // https://stackoverflow.com/questions/6768793/get-the-full-url-in-php
	$u .= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
	$u .= "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	return $u;
    }
    
    private function __construct($redto = false) {

	startSSLSession();

	$this->redto = self::getMyURL();
	$this->dao = new dao_user();
	
	$this->uname = $this->isIn();
	
	$type = self::rType();
	
	if ($type !== 'logout' && $this->uname) return;

	switch($type) {
	    case 'init' : $this->loadUserScreen(); break;
	    case 'cred' : 
	    case 'checkun' : 
		case 'login' :
		$this->creds($type); break; 
	    case 'logout' : 
		$this->logout(); 
	    break;
	}
	

    }
    
    public function logout() {
	$this->dao->logout();
	$ret['msg'] = 'You have been logged out';
	$ret['redto'] = $this->redto;
	kwjae($ret);
    }
    
    private function isIn() {
	
	if (isset($this->uname)) return $this->uname;
	
	$uname = $this->dao->isIn();
	if (!$uname) return false;

	return $uname;
    }
    
    private function unck($uname) {
	
	$ex = $this->dao->exists($uname);
	if ($ex) $msg = "user $uname exists.  If that's you, please continue.";
	else     $msg = "username $uname is available";
	
	$reto = new stdClass();
	$reto->msg = $msg;
	$reto->userisavail = true;
	$reto->action = 'uck';
	kwjae($reto);
    }
    
    
    private function creds($type) {

	kwas(isset($_REQUEST['uname']), 'no username');
	$run =     $_REQUEST['uname'];
	
	// if (!isset(             $_REQUEST['pwd'  ])) $this->unck($run);
	
	if ($type === 'checkun') {
	    $vuname = validUN::orDie($run, self::maxunamel);
	    $this->unck($vuname);
	}
	
	if (!isset(   $_REQUEST['action'])) return;	
	if ($_REQUEST['action'] !== 'login') return;
	if (!isset(           $_REQUEST['pwd']   )) return;
	$this->login($run, $_REQUEST['pwd']);
    }
    
    private function login($run, $pwd) {
		
	$ex = $this->dao->exists($run);
	
	if (!$ex) { 
	    $hash = password::hash($pwd); unset($pwd);
	    $vuname = validUN::orDie($run, self::maxunamel);
	    $this->dao->create($vuname, $hash);
	}
	else  {
	    $hash = $this->dao->getHash($run);
	    kwas(password_verify($pwd, $hash), 'bad uname/pwd'); unset($pwd, $hash);
	    $vuname = $run; unset($run);
	    $this->dao->setLoggedIn($vuname);
	}
	
	$reto = new stdClass();
	$reto->uname = $vuname;
	$reto->msg = "user $vuname ";
	if (!$ex) $reto->msg .= 'created and '; 
	$reto->msg .= 'logged in';
	$reto->status = 'OK';
	$reto->redto = $this->redto;
	
	kwjae($reto);
    }
    
    private static function rType() {
	if (isset ($_REQUEST['action'])) 
	    return $_REQUEST['action'];
	if (!isset($_REQUEST['uname'])) return 'init';

	
	return 'cred';
    }
    
    
    private function loadUserScreen($more = false) {
	
	global $KWUINITO;
	
	$cnt = $this->dao->userCount();
	$ro = [];
	$ro['ucnt'] = $cnt;
	$ro['maxunamel'] = self::maxunamel;
	if ($more) $ro = array_merge($ro, $more);
	
	$KWUINITO = $ro; unset($ro);
	
	require_once('html/login.php');
	exit(0);
    }
    

    public static function echoJS($init = false) {
	
	if ($init) global $KWUINITO;
	
	$ht  = '';
	
	if ($init) {
	    $ht .= '<script>';
	    $ht .= 'const KWUINIT = ' . json_encode($KWUINITO) . ';'; unset($KWUINITO);
	    $ht .= '</script>' . "\n";
	}
	
	$fs = ['utils', 'users'];
	foreach($fs as $f) {
	    $p  = kwynnUsersURL::get();
	    $p .= 'js/';
	    $p .= $f;
	    $p .= '.js';
	    
	    $ht .= "<script src='$p'></script>\n";
	}
	
//	if ($init) {
	    $ht .= '<script>';
	    $ht .= 'const KWUO = new kwusers("uname", "pwd", "loginbtn", "msgs", "credform");';
	    $ht .= '</script>' . "\n";
//	}
	
	echo $ht;
    }
/*    
    public static function getPath() {
	if (ispkwd()) return 'http://sm20/users/';
    } */
}
