<?php 

$online = ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "110.44.121.133" || $_SERVER['HTTP_HOST'] == "localhost:2020" || $_SERVER['HTTP_HOST'] == "127.0.0.1" || $_SERVER['HTTP_HOST'] == "192.168.2.121") ? false : true;
defined('SITE_FOLDER') ? '' : define('SITE_FOLDER', 'babermahalvilas');
defined('SITE_STR')    ? '' : define('SITE_STR', '');
if($online){ // ONLINE SETUP

define('DB_SERVER',   'localhost');
define('DB_USER', 	  'babermah_bbmvls');
define('DB_PASS', 	  '4DU1yyA6JWQQ');
define('DB_NAME', 	  'babermah_bbmvls');

} else { 	// LOCAL SETUP
define('DB_SERVER',   'localhost');
define('DB_USER', 	  'root');
define('DB_PASS', 	  '');
define('DB_NAME', 	  'db_bbmvls');
}
?>