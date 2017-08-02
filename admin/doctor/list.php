<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";
include APP_PATH . "/include/cls_page.php";
include APP_ADM . "/inc/del_file.php";

$act = geturl("act");
$url = "?page={page}";
$did = geturl("did");
$did = is_numeric($did) ? intval($did) : 0;

/*------------------------------------------------------ */
//-- 删除
//   如果是ajax提交
/*------------------------------------------------------ */
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" && $act == "del"){
  $id = geturl("id");
  $id = !is_null($id) ? intval($id) : 0;
  //事务开始
  $db->begin();
  $sql = $db->sqlexe("select pic from `doctors` where id=".$id);
  if(mysqli_num_rows($sql)){
    $row = mysqli_fetch_array($sql);
  }

  if($row["pic"]) deleteFile($row["pic"]);

  $db->sqlexe("delete from `doctors` where id=".$id);

  if($db->mysqli_errno() == 0){
    $db->commit();
    $msg["status"] = 0;
    $msg["m"] = "删除成功！";
    die(json_encode($msg));
  }else{
    $db->rollback();
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
  if($did){
    $recordcount	= $db->fetchfiled( "Select count(id) As num From `doctors` where depid=".$did );	//总记录数
  }else{
    $recordcount	= $db->fetchfiled( "Select count(id) As num From `doctors`");	//总记录数
  }
}else {
  $recordcount	= convert( geturl("rn") );										//如果当前不为第一页，通过url查询总记录
}

$recordcount	= empty($recordcount) ? 0 : $recordcount;						//总记录数
$pageNumber		= ceil($recordcount / $pagesize); 								  //总页数
$nextPage		= ( $page >= $pageNumber ) ? $pageNumber : $page+1;		//下一页
$prevPage		= ( $page > 1 ) ? $page -1 : 1;									      //上一页

if($did){
  $sql = "Select id From `doctors` where depid=".$did." order by id desc limit {$start},{$pagesize}";
}else{
  $sql = "Select id From `doctors` order by id desc limit {$start},{$pagesize}";
}

$idstr  = "";
$ids = $db->query( $sql );
foreach ($ids as $s) {
  $idstr .= ($s['id'] . "," );
}

$idstr = rtrim($idstr,"\,");

if($did){
  $sql = "select d.*,t.titname,t.cost,dep.depname from `doctors` as d inner join `titles` as t inner join `department` as dep where d.id in({$idstr}) and d.depid=dep.id and d.depid=".$did." and d.title=t.id order by d.id desc";
}else{
  $sql = "select d.*,t.titname,t.cost,dep.depname from `doctors` as d inner join `titles` as t inner join `department` as dep where d.id in({$idstr}) and d.depid=dep.id and d.title=t.id order by d.id desc";
}

/* 翻页结束 =============================================================== */

if($idstr){ $res = $db->getAll($sql); }


//翻页相关开始
$pages = new PageClass($page, $pagesize, $recordcount, $url, 2);
$smarty->assign('pages',$pages->showPage());
//翻页相关结束

//====================================================
$smarty->assign("depid",$did);
$smarty->assign("list",$res);
$smarty->display("doctor/list.tpl");
?>
