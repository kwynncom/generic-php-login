<?php

require_once('/opt/kwynn/kwutils.php');

class dao_user extends dao_generic {
    const db = 'users';
	function __construct() {
	    parent::__construct(self::db);
	    $this->ucoll    = $this->client->selectCollection(self::db, 'users');
	    $this->scoll    = $this->client->selectCollection(self::db, 'sessions');
	    if ($this->userCount() === 0) $this->createIndexes();
	}
	
	private function createIndexes() { 
	    $this->ucoll->createIndex(['uname' => -1], ['unique' => true ]);    
	    $this->scoll->createIndex(['sid'   => -1], ['unique' => true ]);    
	}
	
	public function userCount() { return $this->ucoll->count(); }
	
	public function exists ($uname) {  return $this->ucoll->count(['uname' => $uname]); }
	public function getHash($uname) {  
	    $res = $this->ucoll->findOne(['uname' => $uname]);
	    kwas($res && isset($res['hash']), 'bad uname/pwd');
	    return $res['hash'];
	}
	
	public function create($uname, $hash) {
	    $dat['uname'] = $uname;
	    $dat['hash' ] = $hash;
	    $now = time();
	    $dat['crets'] = $now;
	    $dat['crer' ] = date('r', $now);
	    $this->ucoll->insertOne($dat);
	    $this->setLoggedIn($uname);
	}
	
	public function setLoggedIn($uname) {
	    $sdat['uname'] = $uname;
	    $sdat['sid']   = vsidod();
	    $this->scoll->upsert($sdat, $sdat);
	}
	
	public function logout() { $this->scoll->deleteOne(['sid' => vsidod()]); }
	
	public function isIn() {
	    $res = $this->scoll->findOne(['sid' => vsidod()]);
	    if ($res) return $res['uname'];
	    return false;
	}
   
}