<?php
require_once "../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/smarty.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";
include APP_PATH . "/include/cls_page.php";

$url = "?page={page}";

/* 翻页开始 =============================================================== */
$page		= convert( geturl("page") );
$page		= is_numeric($page) ? intval($page) : 1; //当前页
$pagesize	= 20;                                  //每页20条记录
$start		= $pagesize * ($page - 1);	           //每页起始记录

//当前为第一页时，查询总记录数
if( $page == 1 ){
  $recordcount	= $db->fetchfiled( "Select count(id) As num From `catalog`" );	//总记录数
}else {
  $recordcount	= convert( geturl("rn") );										//如果当前不为第一页，通过url查询总记录
}

$recordcount	= empty($recordcount) ? 0 : $recordcount;						//总记录数
$pageNumber		= ceil($recordcount / $pagesize); 								  //总页数
$nextPage		= ( $page >= $pageNumber ) ? $pageNumber : $page+1;		//下一页
$prevPage		= ( $page > 1 ) ? $page -1 : 1;									      //上一页

$sql = "Select id From `catalog` order by id desc limit {$start},{$pagesize}";

$idstr  = "";
$ids = $db->query( $sql );
foreach ($ids as $s) {
  $idstr .= ($s['id'] . "," );
}

$idstr = rtrim($idstr,"\,");

$sql = "select * from `catalog` where id in({$idstr}) order by id desc";

/* 翻页结束 =============================================================== */

if($idstr){ $res = $db->getAll($sql); }

//翻页相关开始
$pages = new PageClass($page, $pagesize, $recordcount, $url, 2);
$smarty->assign('pages',$pages->showPage());
//翻页相关结束


//显示所有栏目列表
function showCats(){
	global $db, $str;
  $sql = $db->sqlexe("select * from `catalog` where parentId=0 and isshow=0");
  if(mysqli_num_rows($sql)){
    while($rows = mysqli_fetch_array($sql)){
      $str .= "<table width='100%' border='0' cellspacing='0' cellpadding='2'>";
      $str .= "<tr><td style='background-color:#f5fcff;' width='2%' class='bline'>";
      $str .= "<table width='98%' border='0' cellspacing='0' cellpadding='0'>";
      $str .= "<tr id='cat".$rows["id"]."'>";
			$str .= "<td style='background-color:#f5fcff;' width='2%' class='bline'><img style='cursor:pointer; margin:0 5px;' id='img6' onclick='LoadSuns('suns6',6);' src='../images/menu_plus.gif' width='9' height='9'></td>";
			$str .= "<td width='50%' class='bline' style='background-color:#f5fcff;'>".$rows["catname"]."</td>";
      $str .= "<td align='right' class='bline' style='background-color:#f5fcff;'><input type='text' name='orders' value='".$rows["orders"]."' class='form-input'></td></tr>";
      $str .= "</table>";
      $str .= "<tr><td colspan='2' id='cat".$rows["id"]."' style='display:none;'>";
      $str .= "<table border='0' cellspacing='0' cellpadding='0' width='100%'>";
      showChildCats($rows["id"]);
      $str .= "</table></td></tr>";
      $str .= "</tr></td></table>";
    }
  }
  return $str;
}

function showChildCats($pId=0){
  global $db, $str;
  $sql = $db->sqlexe("select * from `catalog` where parentId=".intval($pId)."");
  if(mysqli_num_rows($sql)){
    while($rows = mysqli_fetch_array($sql)){
      $str .= "<tr height='24' style='background-color:#fff;'><td class='bline' style='background-color:#f5fcff;'>";
      $str .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
      $str .= "<tr><td width='50%' class='bline' style='background-color:#f5fcff;'>".$rows["catname"]."</td>";
      $str .= "<td align='right' class='bline'><input type='text' name='orders' value='".$rows["orders"]."' class='form-input'></td></tr>";
      $str .= "</table>";
      $str .= "</td></tr>";
      $str .= "<tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'>";
      showChildCats($rows["id"]);
      $str .= "</table></td></tr>";
    }
  }
  return $str;
}

$list = showCats();

//====================================================
$smarty->assign("list",$list);
//$smarty->assign("list",$res);
$smarty->display("cats/list.tpl");
?>
