<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";
include APP_ADM . "/inc/del_file.php";

$act = geturl("act");
$id = geturl("id");
$id = is_numeric($id) || !is_null($id) ? intval($id) : 0;
$sql = $db->sqlexe("select * from `doctors` where id=".$id);
if(mysqli_num_rows($sql)){
  $res = mysqli_fetch_array($sql);
}
$pic = $res["pic"];

/*------------------------------------------------------ */
//-- 保存
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "edsave"){
  $msg = [];
  $docid        = getPost("id");
  $docname      = convert(getPost("docname"));
  $phone        = convert(getPost("phone"));
  $title        = convert(getPost("title"));
  $oldlogo      = convert(getPost("oldlogo"));
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
    "docname"       => $docname,
    "phone"         => $phone,
    "title"         => $title,
    "pic"           => $logo,
    "content"       => $content
  );

  $db->begin();

  if($oldlogo!=$logo) deleteFile(str_replace("../../../","/",$oldlogo));

  $sql = $db->mkUpdatesql("doctors", $data, "id=".intval($docid));
  $db->sqlexe($sql);

  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "修改信息成功";
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
    $tmp[] = $rows;
  }
}else{
  $tmp = [];
}

//===========================================
$smarty->assign("title",$tmp);
$smarty->assign("res",$res);
$smarty->display("doctor/edit.tpl");

?>