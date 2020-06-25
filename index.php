<?php

require_once('/opt/kwynn/kwutils.php');
require_once('dao.php');


class users {
    public function __construct() {
	$this->sid = startSSLSession();
	$this->dao = dao_user();
	if ($this->dao->userCount() === 0) {
	    
	}
    }
    
}

