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
	if (ispkwd()) return self::getKwynnsOwn();
	if (isAWS())  return 'https://kwynn.com/t/20/07/users/';
    }
    
    private static function getKwynnsOwn() {
	$co = new kwynn_creds();
	$url = $co->getType('kwynn_dev_users_url_2020_07', 'url');
	return $url;
    }
}