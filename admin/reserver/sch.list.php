<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";
include APP_PATH . "/include/cls_page.php";

$act = geturl("act");
$docid = geturl("did");
$url = "?page={page}";

/*------------------------------------------------------ */
//-- 删除
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "del"){
  $id = geturl("id");
  $id = !is_null($id) ? intval($id) : 0;
  $sql = $db->sqlexe("delete from `schedule` where id=".$id);
  if($sql){
    $msg["status"] = 0;
    $msg["m"] = "删除成功！";
    die(json_encode($msg));
  }else{
    $msg["status"] = 1;
    $msg["m"] = "删除失败！";
    die(json_encode($msg));
  }
}

/* 翻页开始 =============================================================== */
$page		= convert( geturl('page') );
$page		= is_numeric($page) ? intval($page) : 1; //当前页
$pagesize	= 20;                                  //每页20条记录
$start		= $pagesize * ($page - 1);	           //每页起始记录

//当前为第一页时，查询总记录数
if( $page == 1 ){
  if($docid){
    $wr = "did=".intval($docid);
    $recordcount	= $db->fetchfiled( "Select count(id) As num From `schedule` where {$wr}");	//总记录数
  }else{
    $recordcount	= $db->fetchfiled( "Select count(id) As num From `schedule`");	//总记录数
  }
}else {
  $recordcount	= convert( geturl("rn") );										//如果当前不为第一页，通过url查询总记录
}

$recordcount	= empty($recordcount) ? 0 : $recordcount;						//总记录数
$pageNumber		= ceil($recordcount / $pagesize); 								  //总页数
$nextPage		= ( $page >= $pageNumber ) ? $pageNumber : $page+1;		//下一页
$prevPage		= ( $page > 1 ) ? $page -1 : 1;									      //上一页

if($docid){
  $wr = "did=".intval($docid);
  $sql = "Select id From `schedule` where {$wr} order by id desc limit {$start},{$pagesize}";
}else{
  $sql = "Select id From `schedule` order by id desc limit {$start},{$pagesize}";
}


$idstr  = "";
$ids = $db->query( $sql );
foreach ($ids as $s) {
  $idstr .= ($s['id'] . "," );
}

$idstr = rtrim($idstr,"\,");

$wr2 = $docid ? "and did=".intval($docid)."" : "";
$wr = "sch.did=doc.id {$wr2}";
$sql = "select sch.*,doc.docname from `schedule` as sch inner join `doctors` as doc where sch.id in({$idstr}) and {$wr} order by id desc";

/* 翻页结束 =============================================================== */

if($idstr){ $sql = $db->sqlexe($sql); }

if($idstr){
  while($rows = mysqli_fetch_array($sql)){
    if($rows["week1"] == 11){$w1 = "上午";}elseif($rows["week1"] == 12){$w1 = "下午";}elseif($rows["week1"] == 13){$w1 = "全天";}elseif($rows["week1"] == 14){$w1 = "休息";}
    if($rows["week2"] == 21){$w2 = "上午";}elseif($rows["week2"] == 22){$w2 = "下午";}elseif($rows["week2"] == 23){$w2 = "全天";}elseif($rows["week2"] == 24){$w2 = "休息";}
    if($rows["week3"] == 31){$w3 = "上午";}elseif($rows["week3"] == 32){$w3 = "下午";}elseif($rows["week3"] == 33){$w3 = "全天";}elseif($rows["week3"] == 34){$w3 = "休息";}
    if($rows["week4"] == 41){$w4 = "上午";}elseif($rows["week4"] == 42){$w4 = "下午";}elseif($rows["week4"] == 43){$w4 = "全天";}elseif($rows["week4"] == 44){$w4 = "休息";}
    if($rows["week5"] == 51){$w5 = "上午";}elseif($rows["week5"] == 52){$w5 = "下午";}elseif($rows["week5"] == 53){$w5 = "全天";}elseif($rows["week5"] == 54){$w5 = "休息";}
    if($rows["week6"] == 61){$w6 = "上午";}elseif($rows["week6"] == 62){$w6 = "下午";}elseif($rows["week6"] == 63){$w6 = "全天";}elseif($rows["week6"] == 64){$w6 = "休息";}
    if($rows["week7"] == 71){$w7 = "上午";}elseif($rows["week7"] == 72){$w7 = "下午";}elseif($rows["week7"] == 73){$w7 = "全天";}elseif($rows["week7"] == 74){$w7 = "休息";}
    $list[] = array(
      "id"      => $rows["id"],
      "docid"   => $rows["did"],
      "doctor"  => $rows["docname"],
      "w1"      => $w1,
      "w2"      => $w2,
      "w3"      => $w3,
      "w4"      => $w4,
      "w5"      => $w5,
      "w6"      => $w6,
      "w7"      => $w7,
      "resnum1" => $rows["resnum1"],
      "resnum2" => $rows["resnum2"],
      "start"   => $rows["startDate"],
      "end"     => $rows["endDate"]
    );
  }
}

//翻页相关开始
$pages = new PageClass($page, $pagesize, $recordcount, $url, 2);
$smarty->assign('pages',$pages->showPage());
//翻页相关结束

//====================================================
$smarty->assign("docid",$docid);
$smarty->assign("list",$list);
$smarty->display("reserver/sch.list.tpl");
?>
