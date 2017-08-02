<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";

$id = geturl("id");
$act = geturl("act");

$id = !empty($id) ? intval($id) : 0;
$row = $db->getRow("select * from `department` where id=".$id);

if(is_array($row) || !is_null($row)){
  $res = $row;
}

/*------------------------------------------------------ */
//-- 保存
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "edsave"){
  $msg = [];
  $id           = getPost("depid");
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

  $data = array(
    "depname"       => $depname,
    "phone"         => $phone,
    "address"       => $address,
    "pic"           => $logo,
    "shortcontent"  => $shortcontent,
    "content"       => $content
  );

  $sql = $db->mkUpdatesql("department", $data, "id=".intval($id));
  $db->begin();
  $db->sqlexe($sql);

  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "修改科室成功";
    die(json_encode($msg));
  }else{
    $db->rollback();
    $msg["status"] = 1;
    $msg["m"] = "数据提交失败";
    die(json_encode($msg));
  }

}

//===========================================

$smarty->assign("res",$res);
$smarty->display("depart/edit.tpl");

?>