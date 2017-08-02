<?php
require "../../../include/config.php";
require APP_PATH . "/include/function.php";
require APP_PATH . "/include/fn_post.php";
include APP_ADM . "/inc/del_file.php";

$id = geturl("id");
$id = !empty($id) ? intval($id) : 0;

$sql = $db->sqlexe("select * from `department` where id=".$id);
$msg = [];

if(mysqli_num_rows($sql) > 0){
  //事务开始
  $db->begin();
  $row = mysqli_fetch_array($sql);
  $sql = $db->sqlexe("select * from `doctors` where depid=".$id);
  if(mysqli_num_rows($sql) > 0){
    $msg["status"] = 1;
    $msg["m"] = "该科室下有医生，不能删除！";
    die(json_encode($msg));
  }

  if($row["pic"]){           //如果文章有图片
    $sql = $db->sqlexe("select pic from `department` where id=".$id);     //查找图片表中上传的图片路径并组成字符串
    $pic = $row["pic"];
    deleteFile(str_replace("../../../","/",$pic));                                               //删除图片
  }

  $db->sqlexe("delete from `department` where id=".$id);

  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "删除成功！";
    die(json_encode($msg));
  }else{
    $db->rollback();
    $msg["status"] = 1;
    $msg["m"] = "删除不成功！";
    die(json_encode($msg));
  }
}

?>