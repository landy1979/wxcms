<?php
//获取所有栏目
function getCatalog($pId=0, $spac=0){
  global $str;
  $spac = $spac + 1;
  $sql = "select * from `catalog` where parentId=".intval($pId)." and isshow=0 order by orders";
  $res = $GLOBALS['db']->sqlexe($sql);
  if($res && mysqli_num_rows($res)){
    while($row = mysqli_fetch_array($res)){
      if($row["parentId"] == 0){
        $str .= "<option value=".$row["id"].">". "├" . $row["catname"]."</option>";
      }else{
        $str .= "<option value=".$row["id"].">". str_repeat("&nbsp;",$spac) . "├" . $row["catname"]."</option>";
      }
      getCatalog($row['id'], $spac);
    }
  }
  return $str;
}

//获取字符串中的第一张图片
function getFirstPic($str){
  if(strpos($str,"|") || strpos($str,"|") >= 0){
    $newStr = explode("|",$str);
    return $newStr[0];
  }else{
    return $str;
  }
}