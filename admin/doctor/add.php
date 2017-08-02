<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";

$depid = geturl("depid");
$act = geturl("act");

/*------------------------------------------------------ */
//-- 保存
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "save"){
  $msg = [];
  $depid        = getPost("depid");
  $docname      = convert(getPost("docname"));
  $phone        = convert(getPost("phone"));
  $title        = convert(getPost("title"));
  $logo         = convert(getPost("logo"));
  $content      = convert(getPost("content"));

  if(!$docname) {
    $msg["status"] = 2;
    $msg["m"] = "医生姓名不能为空！";
    die(json_encode($msg));
  }
  if(!$title || $title == 0){
    $msg["status"] = 2;
    $msg["m"] = "请选择医生职务";
    die(json_encode($msg));
  }

  $data = array(
    "depid"         => $depid,
    "docname"       => $docname,
    "phone"         => $phone,
    "title"         => $title,
    "pic"           => $logo,
    "content"       => $content
  );

  $sql = $db->mkInsertsql("doctors", $data);
  $db->begin();
  $db->sqlexe($sql);
  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "医生添加成功";
    die(json_encode($msg));
  }else{
    $db->rollback();
    $msg["status"] = 1;
    $msg["m"] = "数据提交失败";
    die(json_encode($msg));
  }

}

$sql = $db->sqlexe("select * from `titles`");
if(mysqli_num_rows($sql) > 0){
  while($rows = mysqli_fetch_array($sql)){
    $titles[] = $rows;
  }
}else{
  $titles = [];
}

$sql = $db->sqlexe("select * from `department`");
if(mysqli_num_rows($sql) > 0){
  while($rows = mysqli_fetch_array($sql)){
    $depart[] = $rows;
  }
}else{
  $depart = [];
}

//===========================================
$smarty->assign("titles",$titles);
$smarty->assign("depart",$depart);
$smarty->assign("depid",$depid);
$smarty->display("doctor/add.tpl");

?>