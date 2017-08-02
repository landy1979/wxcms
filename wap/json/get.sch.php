<?php
require_once "../../include/config.php";
require_once "../../include/fn_post.php";
require_once "../../include/function.php";

$date = convert(geturl("date"));
$depid = convert(geturl("depid"));

$msg = [];

if(!$date) {
  $msg["msg"] = "数据传输错误！";
  $msg["status"] = 0;
  die(json_encode($msg));
}

$date = strtotime($date);
$w = date("w",$date);
$w = $w == 0 ? 7 : $w;
$week = "week". $w;

$wr = " sch.did=doc.id and doc.title=tit.id and doc.isallow=1 and startDate<=".$date." and endDate>=".$date." and sch.depid=".intval($depid);
$sql = "select sch.id,doctor,did,{$week} as week,resnum1,resnum2,startDate,endDate,doc.pic,doc.title,tit.titname,tit.cost from `schedule` sch inner join `doctors` doc inner join `titles` tit where {$wr}";

$sql = $db->sqlexe($sql);

if(mysqli_num_rows($sql) > 0){
  while($rows = mysqli_fetch_array($sql)){
    $list[] = $rows;
  }
}else{
  $list = array();
}

//查询当天预约排号剩余数量
$sql = $db->sqlexe("select * from `reserver` where restime=".$date);

$resArr = array();

foreach($list as $k){
  $dp = array();
  $daypart = numberToSplit($k["week"]);
  if($daypart == 1){ $dp = ["上午"]; } elseif($daypart == 2) { $dp = ["下午"]; } elseif($daypart == 3){ $dp = ["上午","下午"]; } elseif($daypart == 4){ $dp = ["休息"]; }
  $resArr[] = array(
    "docid"     => $k["did"],
    "doctor"    => $k["doctor"],
    "logo"      => $k["pic"],
    "title"     => $k["titname"],
    "cost"      => $k["cost"],
    "work"      => $daypart,
    "resnum1"   => $k["resnum1"],
    "resnum2"   => $k["resnum2"],
    "daypart"   => $dp
  );
} 

//print_r($resArr);
echo json_encode($resArr);

?>