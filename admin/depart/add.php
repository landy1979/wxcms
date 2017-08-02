<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";

$act = geturl("act");

/*------------------------------------------------------ */
//-- 保存
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "save"){
  $msg = [];
  $depname      = convert(getPost("depname"));
  $phone        = convert(getPost("phone"));
  $address      = convert(getPost("address"));
  $logo         = convert(getPost("logo"));
  $shortcontent = convert(getPost("shortcontent"));
  $content      = convert(getPost("content"));

  if(!$depname) {
    $msg["status"] = 2;
    $msg["m"] = "科室名称不能为空！";
    die(json_encode($msg));
  }

  $sql = $db->sqlexe("select `depname` from `department` where depname='".$depname."'");
  if(mysqli_num_rows($sql)){
    $msg["status"] = 3;
    $msg["m"] = "该科室已存在，不能重复";
    die(json_encode($msg));
  }

  $data = array(
    "depname"       => $depname,
    "phone"         => $phone,
    "address"       => $address,
    "pic"           => $logo,
    "shortcontent"  => $shortcontent,
    "content"       => $content,
    "orders"        => 50
  );

  $sql = $db->mkInsertsql("department", $data);
  $db->begin();
  $db->sqlexe($sql);
  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "科室添加成功";
    die(json_encode($msg));
  }else{
    $db->rollback();
    $msg["status"] = 1;
    $msg["m"] = "数据提交失败";
    die(json_encode($msg));
  }

}

//===========================================
$smarty->display("depart/add.tpl");

?>