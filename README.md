# generic-php-login

Login form, password, and session management

The only part that probably works right now is the password hashing feature.  I'm creating this project now because I spent a lot of time analyzing the PASSWORD_ARGON2ID PHP implementation.  I was targeting 0.4s - 0.5s of runtime for hashing, and now I have set and encoded "options" / parameters for both my local machine and kwynn.com.  

RESEARCH

I didn't run the following, but it looks useful for future reference.  It doesn't go high enough on "time_cost," though.  I include my own benchmark program (much simpler) as "hashTest.php"

https://gist.github.com/Indigo744/e92356282eb808b94d08d9cc6e37884c
