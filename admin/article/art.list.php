<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";
include APP_PATH . "/include/cls_page.php";

$ty = convert(geturl("ty"));
$keyword = convert(geturl("key"));
$like = $ty == 0 ? "title" : "source";

$url = "?page={page}";

/* 翻页开始 =============================================================== */
$page		= convert( geturl('page') );
$page		= is_numeric($page) ? intval($page) : 1; //当前页
$pagesize	= 20;                                  //每页20条记录
$start		= $pagesize * ($page - 1);	           //每页起始记录

//当前为第一页时，查询总记录数
if( $page == 1 ){
  if($keyword){
    $recordcount	= $db->fetchfiled( "Select count(id) As num From `article` where $like like '%{$keyword}%'" );	//总记录数
  }else{
    $recordcount	= $db->fetchfiled( "Select count(id) As num From `article`" );	//总记录数
  }

}else {
  $recordcount	= convert( geturl("rn") );										//如果当前不为第一页，通过url查询总记录
}

$recordcount	= empty($recordcount) ? 0 : $recordcount;						//总记录数
$pageNumber		= ceil($recordcount / $pagesize); 								  //总页数
$nextPage		= ( $page >= $pageNumber ) ? $pageNumber : $page+1;		//下一页
$prevPage		= ( $page > 1 ) ? $page -1 : 1;									      //上一页

if($keyword){
  $sql = "Select id From `article` where $like like '%{$keyword}%' order by id desc limit {$start},{$pagesize}";
}else{
  $sql = "Select id From `article` order by id desc limit {$start},{$pagesize}";
}

$idstr  = "";
$ids = $db->query( $sql );
foreach ($ids as $s) {
  $idstr .= ($s['id'] . "," );
}

$idstr = rtrim($idstr,"\,");

if($keyword){
  $sql = "select a.*,c.catname as catname from `article` as a inner join `catalog` as c where a.id in({$idstr}) and a.catid=c.id and $like like '%{$keyword}%' order by a.addtime desc";
}else{
  $sql = "select a.*,c.catname as catname from `article` as a inner join `catalog` as c where a.id in({$idstr}) and a.catid=c.id order by a.addtime desc";
}

/* 翻页结束 =============================================================== */

if($idstr){ $res = $db->getAll($sql); }


//翻页相关开始
$pages = new PageClass($page, $pagesize, $recordcount, $url, 2);
$smarty->assign('pages',$pages->showPage());
//翻页相关结束

//====================================================
$smarty->assign("list",$res);
$smarty->display("article/art.list.tpl");
?>
