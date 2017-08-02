<?php
require_once "../../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require APP_PATH  . "/include/fn_post.php";
require APP_PATH . "/include/function.php";
require APP_PATH . "/include/cls_picture.php";
require APP_PATH . "/include/cls_thumbpic.php";

/* 读取当前栏目图片尺寸设置 */
$catId = convert(getPost('catId')); //栏目ID
if( !isInt($catId)){ exit("请选择栏目！");}
$size = $db->fetcharray("select cat_thumb_w, cat_thumb_h from `catalog` where id={$catId}");
//$size = $db->fetcharray( "Select index_sp_w,index_sp_h,cat_sp_w,cat_sp_h,other_sp1_w,other_sp1_h,other_sp2_w,other_sp2_h,other_sp3_w,other_sp3_h,thumb_mode From art_catalog Where id={$catId}" );
if( empty($size) || !is_array($size)){exit("请选择栏目{$catId}！");}
/* 读取当前栏目图片尺寸设置 */

require( "thumbmulti.php" );

$url = "msgmulti.php?txt={$txt}&err={$err}&picpath={$savePath}&pics={$pics}&back=savethumbmulti";	
	
header("Location: {$url}");	//跳转时Location:后加一个空格

exit();
?>
