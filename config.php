<?php
error_reporting(E_ALL ^ E_DEPRECATED);
define('DB_USER', "root"); // db user  
define('DB_PASSWORD', ""); // db password  
define('DB_DATABASE', "templeproject"); // database name  
define('DB_SERVER', "localhost"); // db server/ host name  
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());  
$db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error()); 
define("STATUS", "success");
<<<<<<< HEAD

define("SITE_URL",$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/temple");
=======
define("SITE_URL",$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/nittemobileapp");
>>>>>>> parent of 30570a3... video and gallery


?>