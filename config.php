<?php

/* You have to config the URL as below.
 * You might also consider your own password hash PASSWORD_ARGON2ID settings: cost, memory, parallelism, etc.  
 * 
 * /opt/kwynn stuff lives in  https://github.com/kwynncom/kwynn-php-general-utils
 * 
 * I'm sure I'm forgotten something, or at least fairly sure.  */

require_once('/opt/kwynn/creds.php');

class kwynnUsersURL {
    public static function get() {
		return '/t/20/07/users/';
    }
}
