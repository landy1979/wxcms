<?php
require "../../../include/config.php";
require APP_PATH . "/include/function.php";
require APP_PATH . "/include/fn_post.php";

$id = geturl("id");

$id = !empty($id) ? intval($id) : 0;

$sql = $db->sqlexe("select * from `department` where id=".$id);
if(mysqli_num_rows($sql) > 0){
  $row = mysqli_fetch_array($sql);
  $isshow = $row["isshow"] == 1 ? 0 : 1;
  $db->sqlexe("update `department` set isshow=$isshow where id=".$id);
  exit("$isshow");
}

?>