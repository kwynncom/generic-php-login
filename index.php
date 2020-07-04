<?php
require_once('/opt/kwynn/kwutils.php');
require_once('users.php');

$uo = userIO('http://sm20/users/');
$username = $uo->isIn(); unset($uo);

if (!$username) exit(0);

require_once('app.php');
