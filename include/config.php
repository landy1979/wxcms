<?php
header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set("PRC");

define( "APP_PATH",str_replace("\\", "/",realpath(dirname(__FILE__)."/../")) );
define( "APP_WAP", str_replace("\\", "/", realpath(dirname(__FILE__)."/../wap")));
define( "APP_ADM", APP_PATH . "/admin");

require_once "lib_mysqli.php";
$cfg_db = include "db.php";

$db = new lib_mysqli($cfg_db["DB_HOST"],$cfg_db["DB_USER"],$cfg_db["DB_PWD"],$cfg_db["DB_NAME"],$cfg_db["DB_PORT"],$cfg_db["DB_CHAR"]);

?>