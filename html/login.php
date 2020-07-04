<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>login</title>

<style>
    input:invalid { background-color: lightsalmon; }
</style>

<!-- abstract this - begin -->
<?php echo '<script> const KWUINIT = ' . json_encode($kwinito) . '; </script>'; ?>
<script src='js/utils.js'></script>
<script src='js/responses.js'></script>
<script src='js/net.js'></script>
<script src='js/netspecific.js'></script>
<script src='js/uname.js'></script>
<script src='js/users.js'></script>
<!-- abstract this - end -->

</head>
<body>
    <div>
	<form id='credform'> 
	    <!-- be very careful with form usage -->
	    <div id='uinfo'></div>
	    <div id='msgs'>&nbsp;</div>
            <div><label id='unamel'>(create) username:</label><input type='text'     id='uname' autocomplete='username'  /></div>
            <div><label id='pwdl'  >(create) password:</label><input type='password' id='pwd'   autocomplete='current-password' /></div>
	    <div><button id='loginbtn'>(create and) login</button></div>
        </form></div>
</body>
</html>
