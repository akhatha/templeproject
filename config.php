<?php
error_reporting(E_ALL ^ E_DEPRECATED);
define('DB_USER', "nittemobileapp"); // db user  
define('DB_PASSWORD', "9kmd9sjdu"); // db password  
define('DB_DATABASE', "nittemobileapp"); // database name  
define('DB_SERVER', "192.168.12.210"); // db server/ host name  
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());  
$db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error()); 
define("STATUS", "success");
define("SITE_URL",$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/nittemobileapp");
define("GOOGLE_API_KEY", "AIzaSyB9EYiA5p5ScVZZXP2DO4TEHs8Rpq_QvaQ");
define("GOOGLE_GCM_URL", "https://fcm.googleapis.com/fcm/send");

?>