<?php
require "../../../include/config.php";
require APP_PATH . "/include/function.php";
require APP_PATH . "/include/fn_post.php";

$id = geturl("id");

$id = !empty($id) ? intval($id) : 0;

$sql = $db->sqlexe("select * from `doctors` where id=".$id);
if(mysqli_num_rows($sql) > 0){
  $row = mysqli_fetch_array($sql);
  $isallow = $row["isallow"] == 1 ? 0 : 1;
  $db->sqlexe("update `doctors` set isallow=$isallow where id=".$id);
  exit("$isallow");
}

?>