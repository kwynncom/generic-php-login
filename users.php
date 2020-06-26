<?php

// ini_set('html_errors', false);

require_once('/opt/kwynn/kwutils.php');
require_once('dao.php');
require_once('charValidator.php');


function userIO() {
    try {
	new users();    
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

userIO();

class users {
    
    const maxunamel = 50;
    
    public function __construct() {

	$this->sid = startSSLSession();
	$this->dao = new dao_user();
	
	$type = self::rType();
	
	switch($type) {
	    case 'init' : $this->loadUserScreen(); break;
	    case 'cred' : $this->creds(); break;
	}
    }
    
    private function creds() {

	kwas(isset(		$_REQUEST['uname']), 'no username');
	$uname = validUN::orDie($_REQUEST['uname'], self::maxunamel);
	kwas(isset(   $_REQUEST['pwd']), 'no pwd');
	$pwd   =      $_REQUEST['pwd'];
	
    }
    
    private function loadUserScreen() {
	$cnt = $this->dao->userCount();
	$ro = new stdClass();
	$ro->ucnt = $cnt;
	$ro->maxunamel = self::maxunamel;
	
	$kwinito = $ro; unset($ro);
	
	require_once('html/login.php');
    }
    
    private static function rType() {
	if (!isset($_REQUEST['uname'])) return 'init';
	else return 'cred';
    }
}
