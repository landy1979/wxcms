<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";

$id = geturl("id");
$id = is_numeric($id) || !is_null($id) ? intval($id) : 0;
$act = geturl("act");

$sql = $db->sqlexe("select d.*,s.week1,s.week2,s.week3,s.week4,s.week5,s.week6,s.week7,s.resnum1,s.resnum2,s.startDate,s.endDate from `doctors` as d inner join `schedule` as s where d.id=".$id." and d.id=s.did");
if(mysqli_num_rows($sql) == 0){
  $sql = $db->sqlexe("select * from `doctors` where id=".$id."");
}
$res = mysqli_fetch_array($sql);

for($i=1;$i<=7;$i++){
  $reserver .= $res["week".$i] . ",";
}

/*------------------------------------------------------ */
//-- 保存
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "save"){
  $msg = [];
  $doctor = convert(getPost("docname"));
  $docId = convert(getPost("docid"));
  $depid = convert(getPost("depid"));
  $week1 = getPost("week1");
  $week2 = getPost("week2");
  $week3 = getPost("week3");
  $week4 = getPost("week4");
  $week5 = getPost("week5");
  $week6 = getPost("week6");
  $week7 = getPost("week7");

  $resnum1 = convert(getPost("resnum1"));
  $resnum2 = convert(getPost("resnum2"));
  $startDate = convert(getPost("startDate"));
  $endDate   = convert(getPost("endDate"));

  if(!is_numeric($resnum1) || !is_numeric($resnum2)){
    $msg["status"] = 2;
    $msg["m"] = "请输入上午或者下午预约数量，没有请输入0！";
    die(json_encode($msg));
  }

  if(!$startDate || !$endDate){
    $msg["status"] = 3;
    $msg["m"] = "请选择该医生的排班日期";
    die(json_encode($msg));
  }else{
    $start = strtotime($startDate);
    $end = strtotime($endDate);
  }

  $interval = ($end - $start) / 3600 / 24;

  if(intval($interval) != 6){
    $msg["status"] = 5;
    $msg["m"] = "排班时间只能按一个周进行填写！";
    die(json_encode($msg));
  }

  $data = array(
    "doctor"    => $doctor,
    "did"       => intval($docId),
    "depid"     => intval($depid),
    "week1"     => intval($week1),
    "week2"     => intval($week2),
    "week3"     => intval($week3),
    "week4"     => intval($week4),
    "week5"     => intval($week5),
    "week6"     => intval($week6),
    "week7"     => intval($week7),
    "resnum1"   => intval($resnum1),
    "resnum2"   => intval($resnum2),
    "startDate" => intval($start),
    "endDate"   => intval($end)
  );

  $sqlc = $db->sqlexe("select * from `schedule` where did=".intval($docId)." and ( (startDate between $start and $end) or (endDate between $start and $end) )");

  if(mysqli_num_rows($sqlc) > 0){
    $msg["status"] = 4;
    $msg["m"] = "该医生排班时间段已设置过预约信息，请重新选择排班时间！";
    die(json_encode($msg));
  }

  $sql = $db->mkInsertsql("schedule", $data);

  $db->begin();

  $db->sqlexe($sql);

  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "医生预约信息设置成功";
    die(json_encode($msg));
  }else{
    $db->rollback();
    $msg["status"] = 1;
    $msg["m"] = "数据提交失败";
    die(json_encode($msg));
  }

}

//==========================================
function outputWeek($param){
  $str = "";
  $arrWeek = ["一","二","三","四","五","六","天"];
  if($param["count"] > 0){
    for($i=1;$i<=$param["count"];$i++){
      $week = str_replace($i,$arrWeek[$i-1],$i);
      $str .= "<tr>";
      $str .= "<td>星期".$week."：</td>";
      $str .= "<td>";
      $str .= "<input type=\"radio\" name=\"week".$i."\" value=\"".$i."1\" id=\"week".$i."_1\" class=\"input-radio\">&nbsp;上午&nbsp;";
      $str .= "<input type=\"radio\" name=\"week".$i."\" value=\"".$i."2\" id=\"week".$i."_2\" class=\"input-radio\">&nbsp;下午&nbsp;";
      $str .= "<input type=\"radio\" name=\"week".$i."\" value=\"".$i."3\" id=\"week".$i."_3\" class=\"input-radio\">&nbsp;全天&nbsp;";
      $str .= "<input type=\"radio\" name=\"week".$i."\" value=\"".$i."4\" id=\"week".$i."_4\" class=\"input-radio\">&nbsp;休息";
      $str .= "</td>";
      $str .= "</tr>";
    }
  }
  return $str;
}

//===========================================
$smarty->registerPlugin("function","resOfWeek", "outputWeek");
$smarty->assign("reserver",rtrim($reserver,","));
$smarty->assign("res",$res);
$smarty->display("reserver/sch.add.tpl");

?>