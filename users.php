<?php

// ini_set('html_errors', false);

require_once('/opt/kwynn/kwutils.php');
require_once('dao.php');
require_once('charValidator.php');

new users();

class users {
    
    const maxunamel = 10;
    
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

	kwas(isset(   $_REQUEST['uname']), 'no username');
	$uname = trim($_REQUEST['uname']);
	kwas($uname && is_string($uname), 'bad string 1');
	isValidUNC($uname, self::maxunamel);
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
