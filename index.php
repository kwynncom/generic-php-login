<?php
require_once('/opt/kwynn/kwutils.php');
require_once('users.php');

$uo = userIO('http://sm20/users/');
$un = $uo->isIn();

if ($un) {
    header('Content-Type: text/plain');
    echo($un . ' is logged in');
}