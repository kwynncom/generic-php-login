<?php

require_once('/opt/kwynn/kwutils.php');

class password {
    
    const algod = PASSWORD_ARGON2ID;
    
    public static function hash($pwd, $ti = false, $hi = false) { 
	$b = hrtime(1);
	$h = password_hash($pwd, self::algod, self::options()); unset($pwd);
	$e = hrtime(1);
	if (!$ti) return $h; unset($ti);
	$d = $e - $b; unset($b, $e);
	$s = round($d / 1000000000, 4); unset($d);
	$r['hash'] = $h; unset($h);
	$r['s'   ] = $s; unset($s);
	if ($hi) $r['info'] = password_get_info($r['hash']); unset($hi);
	return $r;
    }
    
    public static function options() {
	$ps = [ 'memory_cost_mb' => ['aws' => 16, 'non' => 64],
		'time_cost'      => ['aws' => 30, 'non' => 20],
		'threads'        => ['aws' =>  2, 'non' => 12]    ];
	
	
	$isaws = isAWS();
	$r = [];
	
	foreach($ps as $k  => $va) $r[$k] = $va[$isaws ? 'aws' : 'non'];	
	$r['memory_cost'] = $r['memory_cost_mb'] * 1024;
	unset($r['memory_cost_mb']);
	
	return $r;
    }
}

// $h = password::hash('Rc2T0PI06mJ0KpgNSJ0T', 1, 1);
// unset($x);