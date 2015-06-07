<?php


define('FACEBOOK_APP_ID', '125962467592875');
define('FACEBOOK_SECRET', '2a043a774bf2fddb871be1c472c6d1e7');
define('FB_BASE_URL', 'http://apps.facebook.com/olmasigereken/');
define('APP_BASE_URL', 'http://www.ytmdb.com/');
define('LASTFM_APP_ID', '0254a6c86df6730e94861e840076d500');
define('WEBSITE_ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
define('WEBSITE', 'ytmdb.com');
define('LISTEN_VIEW', 'dinle'); // Bunu değiştireceksen /view/layouts altındaki bu isimli .php dosyasının da adını değiştirmeyi unutma 
define('TWITTER_NAME', 'ytmdb'); //Twitter share ve fallow butonlarında tanımlı
define('FACEBOOK_PAGE', 'InternetMusicDatabase'); //home.php ve dinle.php'deki Facebook like butonlarında tanımlı
/*
 * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
 * Google Developers Console <https://console.developers.google.com/>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */
$GOOGLE_DEVELOPER_KEY = 'AIzaSyD0qlGP_EqTH0RwLq4wKsK7b-hsB3aUV-0';

/* Mysql Settings */
define('MYSQL_HOSTNAME', 'localhost');
define('USERNAME_INSERT', 'cruisear'); // olmasige_insert userın sadece insert ve select izinleri var 
define('USERNAME_UPDATE', 'cruisear'); // olmasige_update userın sadece insert, update ve select izinleri var 
define('USERNAME_SELECT', 'cruisear_select'); // olmasige_select userın sadece select izni var 
define('PASSWORD', 'l122cmx6HB');
define('DATABASE', 'cruisear_muzik');
?>