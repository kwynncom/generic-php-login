<?php

require_once('/opt/kwynn/kwutils.php');

class dao_user extends dao_generic {
    const db = 'users';
	function __construct() {
	    parent::__construct(self::db);
	    $this->ucoll    = $this->client->selectCollection(self::db, 'users');
	    $this->scoll    = $this->client->selectCollection(self::db, 'sessions');
	    $this->rescoll    = $this->client->selectCollection(self::db, 'utempres');
	    if ($this->userCount() === 0) $this->createIndexes();
	}
	
	private function createIndexes() { 
	    $this->ucoll->createIndex(['uname' => -1], ['unique' => true ]);    
	    $this->scoll->createIndex(['sid'   => -1], ['unique' => true ]);    
	    
	}
	
	public function userCount() { return $this->ucoll->count(); }
	
	public function uqOrDie($uname) { kwas($this->exists($uname) === 0, 
		"user $uname exists.  If that's you, please continue.");
	}
	
	public function exists ($uname) {  
	    $q = ['uname' => $uname];
	    $cnt = $this->ucoll->count($q); 
	    if ($cnt) return $cnt;

	    $this->reserve($q);
	    
	}
	
	private function reserve($q) {
	    $this->rescoll->deleteMany(['reserved_at' => ['$lt' => time() -  600], 'reserved_sid' => ['$neq' => vsidod()]]);
	    $this->rescoll->deleteMany(['reserved_at' => ['$lt' => time() - 1800]]);
	    $this->rescoll->upsert($q, 
		array_merge($q, ['reserved_at' => time(),
				 'reserved_sid' => vsidod()]));
	}
	
	private function ckRes($uname) {
	    $q = ['uname' => $uname];
	    $res = $this->ucoll->findOneAndUpdate($q);
	    if (!$res || !isset($res['reserved_sid'])) return;
	    kwas(               $res['reserved_sid'] === vsidod(), 'username reserved for creation for several minutes');
	    
	}
	
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