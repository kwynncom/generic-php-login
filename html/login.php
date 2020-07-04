<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>login</title>

<style>
    input:invalid { background-color: lightsalmon; }
    #credform { font-family: monospace; }
</style>

<?php users::echoJS(1); ?>

</head>
<body>
    <div>
	<form id='credform'> <!-- My use of a form assumes "onsubmit" override or else there is a double HTTP call and bad things happen. -->	    
	    <div id='msgs'>&nbsp;</div>
            <div><label  id='unamel'  >(create) username:</label><input type='text'     id='uname' autocomplete='username'  /></div>
            <div><label  id='pwdl'    >(create) password:</label><input type='password' id='pwd'   autocomplete='current-password' /></div>
	    <div><button id='loginbtn'>(create and) login</button></div>
        </form></div>
</body>
</html>
