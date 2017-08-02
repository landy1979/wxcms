<?php
require( '../../../include/config.php' );
require( '../../../include/function.php' );
require( '../../../include/fn_post.php' );


$picid = convert(geturl('picid'));

$picid = isInt($picid) ? intval($picid) : 0;

$isfirst = convert(geturl('isfirst'));

$isfirst = isInt($isfirst) ? intval($isfirst) : 0;

$path = $_GET['path'];

$path = str_replace('../','',$path);

$path = '../../../' . $path;

$pics = $_GET['pics'];

$pic = explode( ",", $pics );

$len = count( $pic );

for( $i=0; $i<$len; $i++ ){
	
	$file = $path . $pic[$i];
	
	if( file_exists($file) )unlink($file);
	
}

if( $isfirst > 0 || $picid > 0 ){

	//如果删除的是第一张图片，更新当前商品的第一张图片为null
	if( $isfirst > 0 ){ $db->sqlexe( "Update art_otherpic Set img1=null,img2=null,img3=null,img4=null,imgapp=null Where id={$isfirst}" ); }
	
	//如果删除的不是第一张图片，则从potherpic表中删除当前图片记录
	if( $picid > 0 ){ $db->sqlexe( "delete from art_otherpic Where id={$picid}" ); }
}

exit('1');

?>