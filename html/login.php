<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>login</title>

<style>
    input:invalid { background-color: lightsalmon; }
</style>
<script>const KWUINIT = <?php echo json_encode($kwinito); ?>;</script>
<script src='js/utils.js'></script>
<script src='js/net.js'></script>
<script src='js/users.js'></script>

</head>
<body>
    <div><form>
	    <div id='uinfo'></div>
            <div><label id='unamel'>username:</label><input type='text'     id='uname' autocomplete='username' maxlength='50' /></div>
            <div><label id='pwdl'  >password:</label><input type='password' id='pwd'   autocomplete='current-password' /></div>
	    <div><button id='loginbtn'>login</button></div>
        </form></div>
</body>
</html>
