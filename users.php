<?php

// ini_set('html_errors', false);

require_once('/opt/kwynn/kwutils.php');
require_once('dao.php');
require_once('charValidator.php');
require_once('password.php');


function userIO($redtoin = false) {
    try {
	if ($redtoin && $redtoin !== 'self') $redto = $redtoin;
	else $redto = false;
	$o = new users($redto);
	return $o;
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

userIO('self');

class users {
    
    const maxunamel = 50;
    
    public function __construct($redto = false) {

	startSSLSession();

	if ($redto) $_SESSION['redto'] = $redto;
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
	$ret['redto'] = 'http://sm20/users/';
	kwjae($ret);
    }
    
    public function isIn() {
	
	if (isset($this->uname)) return $this->uname;
	
	$uname = $this->dao->isIn();
	if (!$uname) return false;

	return $uname;
    }
    
    private static function unckok($uname) {
	$reto = new stdClass();
	$reto->msg = "username $uname is available";
	$reto->userisavail = true;
	kwjae($reto);
    }
    
    private function creds($type) {

	kwas(isset(		$_REQUEST['uname']), 'no username');
	$uname = validUN::orDie($_REQUEST['uname'], self::maxunamel);
	if (!isset(             $_REQUEST['pwd'  ])) $this->dao->uqOrDie($uname);
	
	if ($type === 'checkun') return self::unckok($uname);
	
	if (!isset(   $_REQUEST['action'])) return;	
	if ($_REQUEST['action'] !== 'login') return;
	if (!isset(           $_REQUEST['pwd']   )) return;
	$this->login($uname, $_REQUEST['pwd']);
    }
    
    private function login($uname, $pwd) {
	$ex = $this->dao->exists($uname);
	
	if (!$ex) { 
	    $hash = password::hash($pwd); unset($pwd);
	    $this->dao->create($uname, $hash);
	}
	else  {
	    $hash = $this->dao->getHash($uname);
	    kwas(password_verify($pwd, $hash), 'bad uname/pwd'); unset($pwd, $hash);
	    $this->dao->setLoggedIn($uname);
	}
	
	$reto = new stdClass();
	$reto->uname = $uname;
	$reto->msg = "user $uname ";
	if (!$ex) $reto->msg .= 'created and '; 
	$reto->msg .= 'logged in';
	$reto->status = 'OK';
	// $reto->action = 'created';
	if (isset($_SESSION['redto'])) $reto->redto = $_SESSION['redto'];
	
	kwjae($reto);
    }
    
    private function loadUserScreen($more = false) {
	$cnt = $this->dao->userCount();
	$ro = [];
	$ro['ucnt'] = $cnt;
	$ro['maxunamel'] = self::maxunamel;
	if ($more) $ro = array_merge($ro, $more);

	
	$kwinito = $ro; unset($ro);
	
	require_once('html/login.php');
    }
    
    private static function rType() {
	if (isset ($_REQUEST['action'])) 
	    return $_REQUEST['action'];
	if (!isset($_REQUEST['uname'])) return 'init';

	
	return 'cred';
    }
}
