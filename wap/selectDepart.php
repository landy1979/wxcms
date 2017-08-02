<?php
require_once "../include/config.php";
require_once "../include/smarty.php";
require_once "../include/function.php";

$data = array();
$sql = $db->sqlexe("select id,depname,phone,pic,shortcontent,content from `department` where isshow=0 order by id desc");
if(mysqli_num_rows($sql)){
  while($rows = mysqli_fetch_array($sql)){
    $data[] = $rows;
  }
}

if(is_array($data) || $data){
  foreach($data as $k){
    $nums = 0;
    $rows = $db->getRow("select count(id) as nums from `schedule` where depid=".$k["id"]."");
    $nums = $rows["nums"];
    $intro = $k["shortcontent"] ? $k["shortcontent"] : replacepic($k["content"]);
    $intro = csubstr($intro,0,40,"utf-8",true);
    $list[] = array(
      "id"            => $k["id"],
      "depname"       => $k["depname"],
      "phone"         => $k["phone"],
      "nums"          => $nums,
      "pic"           => $k["pic"],
      "shortcontent"  => $intro
    );
  }
}

//=================================================
$smarty->assign("list",$list);
$smarty->display("wap/reserver/selectDepart.tpl");
?>