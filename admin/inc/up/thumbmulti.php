<?php

//创建缩略图
function createthumb( $old_file, $save_path, $width, $height, $new_name, $mode){
	$modes = $mode;
	$wh = @getimagesize( $old_file );//获得图片宽高,返回数组;
	$w = $wh[0];//原图宽
	$h = $wh[1];//原图高
	if( $width == $height || abs($width-$height) <=5 ){ /* 如果要生成的缩略图为正方形，判原图是否为正方形图片 */
		if( $w < $h ){
			$modes = 1;
		}elseif ( $w > $h ){
			$modes = 2;
		}else {
			$modes = 0;
		}
	}
	$oImage = new scaleZoomImage();
	$oImage->oImName = $old_file;
	$oImage->newImgPath = $save_path; //缩略图存放路径
	$oImage->newWidth  =$width; //缩略图宽度
	$oImage->newHeight = $height; //缩略图高度
	$oImage->mode = $modes;
	$newFile = $oImage->createThumb( $new_name ); //创建缩略图,按宽等比例缩放
	return $newFile;
}

//只保留文件名，不带路径字符串
function getonlyfilename( $save_path, $full_filename ){
	return str_replace( $save_path,'',$full_filename );
}

//上传结束后，检查图片是否已经损坏
function picIsDamage( $pic_url, $pic_ext ){
	$bln = true;
	switch ( strtolower($pic_ext) ){
		case 'jpg' : $im = @imagecreatefromjpeg( $pic_url ); break;
		case 'gif' : $im = @imagecreatefromgif( $pic_url ); break;
		case 'png' : $im = @imagecreatefrompng( $pic_url ); break;
		default:
			$im = false;
	}
	if(!$im) {
        return false;
    }else{
		return true;	
	}
}




$success = false;
$newFolder = date("ymd",time());
$savePath = '../../../data/upload/'.$newFolder."/";
if (!is_dir($savePath)) {mkdir($savePath, 0777, true);}
$isSuccess = uploadpicture( $form='up_file', $savepath=$savePath );

$err = $isSuccess['err'];
$pic = $isSuccess['file'];
$picname = $isSuccess['newName'];
$name = explode( ".", $picname );

if($err == 0){
	if( picIsDamage($pic, $name[1]) )	{//检查图片是否已经损坏
		$t1 = createthumb( $pic, $savepath, $size['cat_thumb_w'], $size['cat_thumb_h'], ($name[0].'-'.$size['cat_thumb_w']), $size['thumb_mode'] ); //缩略图二
//		$t1 = createthumb( $pic, $savepath, $size['index_sp_w'], $size['index_sp_h'], $name[0].'-b', $size['thumb_mode'] ); //缩略图一
//		$t2 = createthumb( $pic, $savepath, $size['cat_sp_w'], $size['cat_sp_h'], ($name[0].'-'.$size['cat_sp_w']), $size['thumb_mode'] ); //缩略图二
//		$t3 = createthumb( $pic, $savepath, $size['other_sp1_w'], $size['other_sp1_h'], ($name[0].'-'.$size['other_sp1_w']), $size['thumb_mode'] ); //缩略图三
//		$t4 = createthumb( $pic, $savepath, $size['other_sp2_w'], $size['other_sp2_h'], ($name[0].'-'.$size['other_sp2_w']), $size['thumb_mode'] ); //缩略图四
//		$t5 = createthumb( $pic, $savepath, $size['other_sp3_w'], $size['other_sp3_h'], ($name[0].'-'.$size['other_sp3_w']), $size['thumb_mode'] ); //缩略图五
		if( $t1 === $pic ){ $t1 = $savePath.$name[0].'-b.'.$name[1]; rename( $pic, $t1 ); }
		$t1 = getonlyfilename( $savePath, $t1 );
//		$t2 = getonlyfilename( $savePath, $t2 );
//		$t3 = getonlyfilename( $savePath, $t3 );
//		$t4 = getonlyfilename( $savePath, $t4 );
//		$t5 = getonlyfilename( $savePath, $t5 );
		//rename( $pic, $savePath.$name[0].'-init.'.$name[1] );
		$success = true;
	}else{
		$success = false;
		$err = 11;
	}
	if( $t1 != getonlyfilename( $savePath, $pic ) ){
		if( file_exists($pic) )unlink($pic); //删除原图
	}
}

$txt = urlencode(uploadmsg( $err ));
$pics = '';

if( $success ){ 
	$t = array();
	$t[] = $t1;
//	$t[] = $t2;
//	$t[] = $t3;
//	$t[] = $t4;
//	$t[] = $t5;
	$pics = implode(",",$t);
}

?>