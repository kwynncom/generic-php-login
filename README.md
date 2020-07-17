# generic-php-login

Login form, password, and session management

GOING BACKWARD IN TIME

07/16  11:07pm

https://kwynn.com/t/20/07/users/  - running at


07/03 

11:46pm

Should be working again.  


11:36pm

The previous version is working well.  I'm considering a reservation system for the very unlikely situation of two users vying for the same username 
at the same time.  I'm starting to think that this is just not worth worrying about, although I should do *something*.


07/02 8:51pm

Now appears to create a user and then redirect as logged in.  Also keeps session and shows logged in without new cred entry.


06/25 4:05pm

Actively developing.  I may use GitHub as a backup.  Why not?


FIRST ENTRY - late 2020/06/24 / early 06/25 EDT (GMT -4 Atlanta / New York)

The only part that probably works right now is the password hashing feature.  I'm creating this project now because I spent a lot of time analyzing the 
PASSWORD_ARGON2ID PHP implementation.  I was targeting 0.4s - 0.5s of runtime for hashing, and now I have set and encoded "options" / parameters for both 
my local machine and kwynn.com.  

RESEARCH

I didn't run the following, but it looks useful for future reference.  It doesn't go high enough on "time_cost," though.  I include my own benchmark 
program (much simpler) as "hashTest.php"

https://gist.github.com/Indigo744/e92356282eb808b94d08d9cc6e37884c

I might get rid of my hashTest in the next version, as a matter of removing clutter.  If I understand how GitHub works, this will be the permanent link:

https://github.com/kwynncom/generic-php-login/blob/906c425e239642e9140fa234676b425933d481e6/hashTest.php
