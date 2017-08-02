<?php
require_once "../include/config.php";
require_once "../include/smarty.php";
require_once "../include/fn_post.php";
require_once "../include/function.php";

$depid = geturl("depid");
$depid = is_numeric($depid) || !is_null($depid) ? intval($depid) : 0;
$res = $db->getRow("select * from `department` where id=".$depid);
if(is_array($res) || $res){
  $result = $res;
}

if($result["shortcontent"]){
  $content = $result["shortcontent"];
}else{
  $content = $result["content"];
}

$content = reconverthtml($content);

$sql = $db->sqlexe("select * from `doctors` where depid=".$depid);
$data = [];
if(mysqli_num_rows($sql)){
  while($rows = mysqli_fetch_array($sql)){
    $data[] = $rows;
  }
}

//=================================================
$smarty->assign("content",$content);
$smarty->assign("res",$result);
$smarty->assign("list",$list);
$smarty->display("wap/reserver/choosedoctor.tpl");
?>