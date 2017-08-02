<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/cls_pinyin.php";
include APP_ADM . "/inc/db.fun.php";

$act = geturl("act");

/*------------------------------------------------------ */
//-- 保存
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "save"){
  $msg = [];
  $parentId     = getPost("parent");
  $catname      = convert(getPost("catname"));
  $folder       = convert(getPost("folder"));
  $onepage      = getPost("onepage");
  $orders       = getPost("orders");
  $logo         = convert(getPost("logo"));
  $tpllist      = convert(getPost("tpllist"));
  $arclist      = convert(getPost("arclist"));
  $seotitle     = convert(getPost("seotitle"));
  $keyword      = convert(getPost("keyword"));
  $description  = convert(getPost("description"));
  $content      = convert(getPost("content"));

  if(!$catname) {
    $msg["status"] = 2;
    $msg["m"] = "栏目名称不能为空！";
    die(json_encode($msg));
  }

  $py = new PinYin();
  if(!$folder) { $folder = $py->getAllPY($catname); }

  $res = $db->fetchfiled("select `folder` from `catalog` where folder='".$folder."'");
  if($res){
    $msg["status"] = 3;
    $msg["m"] = "栏目保存目录不能重复";
    die(json_encode($msg));
  }

  $data = array(
    "parentId"    => intval($parentId),
    "catname"     => $catname,
    "folder"      => $folder,
    "onepage"     => intval($onepage),
    "tpl_list"    => $tpllist,
    "tpl_article" => $arclist,
    "logo"        => $logo,
    "orders"      => intval($orders),
    "catdesc"     => $description,
    "seotitle"    => $seotitle,
    "keyword"     => $keyword,
    "content"     => $content
  );

  $sql = $db->mkInsertsql("catalog", $data);
  $db->begin();
  $db->sqlexe($sql);
  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "栏目添加成功";
    die(json_encode($msg));
  }else{
    $db->rollback();
    $msg["status"] = 1;
    $msg["m"] = "数据提交失败";
    die(json_encode($msg));
  }

}

//===========================================
$smarty->assign("cats",getCatalog(0));
$smarty->display("cats/add.tpl");

?>