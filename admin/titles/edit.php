<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";

$id = geturl("id");
$id = !is_null($id) ? intval($id) : 0;
$row = $db->getRow("select * from `titles` where id=".$id);
if($row || is_array($row)){
  $res = $row;
}

$act = geturl("act");

/*------------------------------------------------------ */
//-- 修改
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "edsave"){
  $msg = [];
  $id = convert(getPost("id"));
  $titlename   = convert(getPost("titlename"));
  $cost        = convert(getPost("cost"));

  if(!$titlename) {
    $msg["status"] = 2;
    $msg["m"] = "医生职称不能为空！";
    die(json_encode($msg));
  }

  if(!$cost || !is_numeric($cost)) {
    $msg["status"] = 2;
    $msg["m"] = "预约费用格式不正确！";
    die(json_encode($msg));
  }

  $data = array(
      "titname"   => $titlename,
      "cost"      => floatval($cost)
  );

  $sql = $db->mkUpdatesql("titles", $data, "id=".intval($id));
  $db->begin();
  $db->sqlexe($sql);
  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "医生职称修改成功";
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
$smarty->display("titles/edit.tpl");

?>