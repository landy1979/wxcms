<?php
require_once "../../include/config.php";
require_once "smarty.php";;

if($smarty->clearAllCache() == 0){
  exit("0");
}else{
  exit("1");
}

?>