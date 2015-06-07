<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 'on');
ini_set('memory_limit', '128M');

/**
 * @file
 * A single location to store configuration.
 */
define('WEBSITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('APP_DIRECTORY', 'blog');
define('APP_BASE_URL', 'http://blog.cruisear.com/');

/* Twitter settings */ 
define('CONSUMER_KEY', 'O7OFFoLvtNfjyQKtnuoQw');
define('CONSUMER_SECRET', 'NAp0VawIIjbIoJyiEGjiUz488QQphXQUXzHU9DMYHHg');
define('OAUTH_CALLBACK', APP_BASE_URL.'callback.php');
define('TWITTER_LIB_PATH', 'class/twitteroauth/twitteroauth.php');
define('CODEBIRD_LIB_PATH', 'class/src/codebird.php');

/* IPINFODB settings */
define('IPINFODB_KEY', '48c549b6a296b028b260f59cd4fe322a851fac77c6b95630e1ed91831255aa28');

/* Mysql Settings */
define('MYSQL_HOSTNAME', 'localhost');
define('USERNAME', 'cruisear');
define('PASSWORD', 'l122cmx6HB');
define('DATABASE', 'cruisear_vat');

?>