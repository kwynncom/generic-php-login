<?php

require_once('/opt/kwynn/kwutils.php');

class dao_user extends dao_generic {
    const db = 'users';
	function __construct() {
	    parent::__construct(self::db);
	    $this->ucoll    = $this->client->selectCollection(self::db, 'users');
	    if ($this->userCount() === 0) $this->createIndex();
	}
	
	private function createIndex() { $this->ucoll->createIndex(['uname' => -1], ['unique' => true ]);    }
	
	public function userCount() { return $this->ucoll->count(); }
	
	public function uqOrDie($uname) { kwas($this->ucoll->count(['uname' => $uname]) === 0, "user $uname exists");	}
	
	public function create($uname, $hash) {
	    $dat['uname'] = $uname;
	    $dat['hash' ] = $hash;
	    $this->ucoll->insertOne($dat);
	}
   
}