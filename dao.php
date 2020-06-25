<?php

require_once('/opt/kwynn/kwutils.php');

class dao_user extends dao_generic {
    const db = 'users';
	function __construct() {
	    parent::__construct(self::db);
	    $this->ucoll    = $this->client->selectCollection(self::db, 'users');
	}
	
	public function userCount() { return $this->ucoll->count(); }
   
}