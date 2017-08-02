<?php
require_once "../include/config.php";
require_once "../include/smarty.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";

$catid = geturl("id");
//获取栏目信息
$cat = $db->getRow("select `logo`,`catname` from `catalog` where id=".intval($catid)."");
$catname = $cat["catname"];

$sql = $db->sqlexe("select `id`,`title`,`ispic`,`titlepic`,`isallow` from `article` where ispic=1 and isallow=1 and catid=".intval($catid)." order by addtime desc limit 0,3");

$picArr = array();
if(mysqli_num_rows($sql) > 0){
  while($rows = mysqli_fetch_array($sql)){
    $picArr[] = $rows;
  }
}

$list = array();
$sql = $db->sqlexe("select `id`,`title`,`titlepic`,`click`,`isallow`,`addtime`,`shortbody` from `article` where catid=".intval($catid)." order by addtime desc");
if(mysqli_num_rows($sql) > 0){
  while($rows = mysqli_fetch_array($sql)){
    $body = $rows["shortbody"];
    if(strlen($body) == 0) {
      $row = $db->getRow("select `wapbody` from `art_body` where art_id=".intval($rows["id"]));
      $body = $row["wapbody"];
    }
    $body = csubstr($body,0,100,'utf-8',true);
    $list[] = array(
      "id"        => $rows["id"],
      "title"     => replacepic($rows["title"]),
      "titlepic"  => $rows["titlepic"],
      "desc"      => $body,
      "addtime"   => $rows["addtime"]
    );
  }
}

switch ($catid) {
  case 14:
    $tpl = "list_thumb.tpl";
    break;
  default:          //带缩略图文章列表
    $tpl = "list.tpl";
    break;
}

//==========================================================================

$smarty->assign("catname",$catname);
$smarty->assign("cat",$cat);
$smarty->assign("list",$list);
$smarty->assign("pics",$picArr);
$smarty->display("wap/".$tpl);
?>