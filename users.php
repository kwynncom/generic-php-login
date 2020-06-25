<?php

require_once('/opt/kwynn/kwutils.php');
require_once('dao.php');

new users();

class users {
        
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
	
    }
    
    private function loadUserScreen() {
	$cnt = $this->dao->userCount();
	$ro = new stdClass();
	$ro->ucnt = $cnt;
	
	$kwinito = $ro; unset($ro);
	
	require_once('html/login.php');
    }
    
    private static function rType() {
	if (!isset($_REQUEST['uname'])) return 'init';
	else return 'cred';
    }
    
}


