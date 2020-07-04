<?php
require_once('/opt/kwynn/kwutils.php');
require_once('users.php');

$uo = users::get();
$username = $uo->isIn(); unset($uo);

require_once('app.php');
