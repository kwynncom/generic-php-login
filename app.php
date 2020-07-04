<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>users app example</title>

<!-- abstract this - begin -->
<!-- <script>const KWUINIT = <?php /* echo json_encode($kwinito); */ ?>;</script> -->
<script src='js/utils.js'></script>
<script src='js/users.js'></script>
<!-- abstract this - end -->


</head>
<body>
    <div>
	<?php if ($username) { 
	    echo("user $username is logged in"); ?>
	<div><button onclick="logout();">log out</button></div>
	<?php } ?>
    </div>
</body>
</html>
