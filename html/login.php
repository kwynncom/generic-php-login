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
            <div><label               >(create) username:</label><input type='text'     id='uname' autocomplete='username'  /></div>
            <div><label               >(create) password:</label><input type='password' id='pwd'   autocomplete='current-password' /></div>
	    <div><button id='loginbtn'>(create and) login</button></div>
        </form></div>
    
    <div>
	<h1>Notes</h1>
			 
	 <p>If you start to get invested in something that uses this login system (the to do list will come first), please let me know (see just below).
	     Otherwise, I may delete users willy nilly because I'm not expecting any yet or perhaps ever.
	     My contact info is on <a href='http://kwynn.com/t/3/02/Buess_resume.html'>my resume</a>, and I am otherwise not hard to find.  My first and last name are worldwide unique.
	     
	 </p>
	
	
	<p>I, Kwynn, am going to start using this for myself, as of July 16, 2020 or soon thereafter.  I plan to use a new, long, random password. 
	    It's never a good idea to re-use passwords, of course.	    
	</p>
	
	<p>On one hand, I have thought this through to some degree.  On the other hand, I do not claim to be an expert in security, I plan to use a 
	    password as above, I may never revisit the security of this system, etc.  Don't re-use a password,	and any damage is limited to this site.</p>
	
	<p>Also, there is currently no way to change the password or delete your user or anything else of the sort.  I'm in no hurry to build 
	    all that.  
	    </p>
	    
	 <p>There is also not a "logout all sessions."  That is somewhat higher on the list, but who knows when?</p>
	 
	 <p>The <a href='https://github.com/kwynncom/generic-php-login'>code is on my GitHub</a>, but I suspect sometimes it will be out of sync.
	     
	 </p>

    </div>
</body>
</html>
