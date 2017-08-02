<?php
require_once "../include/config.php";
require_once "../include/smarty.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";

$artId = convert(geturl("id"));
$artId = is_numeric($artId) ? intval($artId) : exit();

switch ($artId){
  case 29:
    $sql = "select `id`,`catname`,`onepage`,`keyword`,`content`,`isshow` from `catalog` where id=".$artId;
    break;
  default :
    $sql = "select a.*,c.catname from `article` as a inner join `catalog` as c where a.catid=c.id and a.id=".$artId;
    break;
}

$sql = $db->sqlexe($sql);

$res = array();

if($artId == 29) {
  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_array($sql);
    $res = array(
      "id"      => $row["id"],
      "catname" => $row["catname"],
      "body"    => reconverthtml($row["content"])
    );
  }
}else{
  if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_array($sql);
    $result = $db->getRow("select `wapbody` from `art_body` where art_id=".$artId);
    $wapbody = $result["wapbody"];
    $body = $wapbody ? reconverthtml($wapbody) : "";
  }

  $res = array(
    "id"      => $row["id"],
    "title"   => $row["title"],
    "shortit" => $row["shorttitle"],
    "catid"   => $row["catid"],
    "catname" => $row["catname"],
    "source"  => $row["source"],
    "writer"  => $row["writer"],
    "keyword" => $row["keyword"],
    "addtime" => $row["addtime"],
    "body"    => $body
  );
}

//========================================
$smarty->assign("res",$res);
$smarty->display("wap/article.tpl");
?>