<?php

require_once('/opt/kwynn/kwutils.php');
require_once('dao.php');


class users {
    public function __construct() {
	$this->sid = startSSLSession();
	$this->dao = new dao_user();
	$cnt = $this->dao->userCount();
	$ro = new stdClass();
	$ro->ucnt = $cnt;
	$this->loadUserScreen($ro);
	// kwjae($ro);
    }
    
    private function loadUserScreen($kwinito) {
	require_once('html/login.php');
    }
    
}

new users();

