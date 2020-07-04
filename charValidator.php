<?php

class validUN {
    
const nodecmd1 = 'node ' . __DIR__ . '/js/dangerousChar_Node.js' . ' ';

public static function orDie($sin, $maxl) {
    
    kwas(is_string($sin), 'username must be string');
    $sin = trim($sin);
    kwas(mb_check_encoding($sin, '7bit'), 'invalid character set', 22001);
    kwas(strlen($sin) <= $maxl, "username limited to $maxl characters");
    
    $esht = self::ht($sin); unset($sin);
    self::node1($esht);
    
    for ($i=0; $i < strlen($esht); $i++) kwas(ord($esht[$i]) >= 32, 'invalid characters - less than ascii 32', 22351);
    
    return $esht;
}

private static function ht($sin) {
    $esht = htmlspecialchars($sin);
    kwas($esht === $sin, 'invalid characters 3', 22391); unset($sin);
    return $esht;
}

private static function node1($sin) {

    $esarg = escapeshellarg($sin);
    self::ckesarg($sin, $esarg);
    $cmd = self::nodecmd1 . ' ' . $esarg . ' ';
    $nres = trim(shell_exec($cmd));
    kwas($nres === 'OK_node_kw_vcheck1', 'invalid characters 2', 22291);
}

private static function ckesarg($os, $es) {
    $res = preg_match("/'([^']+)'/", $es, $matches);
    kwas($res && isset($matches[1]), 'invalid characters 4', 22571); 
    kwas($matches[1] === $os, 'invalid characters 5', 22581); unset($sin);   
}
}
