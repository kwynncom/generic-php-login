<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>users app example</title>

<?php users::echoJS(); ?>

</head>
<body>
    <div>
	<?php 	
	
	    $uname = users::getUName();
	
	    if (     isset($uname)) {
	    echo('user ' . $uname . ' is logged in'); ?>
	<?php } ?>
	<div><button onclick="logout();">log out</button></div>
    </div>
</body>
</html>
