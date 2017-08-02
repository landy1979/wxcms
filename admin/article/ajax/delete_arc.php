<?php
require "../../../include/config.php";
require APP_PATH . "/include/function.php";
require APP_PATH . "/include/fn_post.php";
include APP_ADM . "/inc/del_file.php";

$id = geturl("id");

$id = !empty($id) ? intval($id) : 0;

$sql = $db->sqlexe("select * from `article` where id=".$id);

if(mysqli_num_rows($sql) > 0){
  $pics = "";
  //事务开始
  $db->begin();
  $row = mysqli_fetch_array($sql);

  if($row["ispic"] == 1){           //如果文章有图片
    $sql = $db->sqlexe("select * from `pic_info` where art_id=".$id);     //查找图片表中上传的图片路径并组成字符串
    while($row = mysqli_fetch_array($sql)){
      $pics .= $row["path"] . $row["picname"] . "|";
    }
    $pics = rtrim($pics, "|");
    deletemutliFile($pics);                                               //删除图片
    $db->sqlexe("delete from `pic_info` where art_id=".$id);
  }

  $db->sqlexe("delete from `article` where id=".$id);
  $db->sqlexe("delete from `art_body` where art_id=".$id);

  if($db->mysqli_errno() == 0){
    $db->commit();
    exit("0");
  }else{
    $db->rollback();
    exit("1");
  }
}


?>