<?php
require_once "../../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require APP_PATH  . "/include/fn_post.php";
require APP_PATH . "/include/function.php";
require APP_PATH . "/include/cls_picture.php";
require APP_PATH . "/include/cls_thumbpic.php";

//创建缩略图
function createthumb( $old_file, $save_path, $width, $height, $new_name){
	$oImage = new scaleZoomImage();
	$oImage->oImName = $old_file;
	$oImage->newImgPath = $save_path; //缩略图存放路径
	$oImage->newWidth  =$width; //缩略图宽度
	$oImage->newHeight = $height; //缩略图高度
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
$savePath = '../../../data/upload/product/'.$newFolder."/";
if (!is_dir($savePath)) {mkdir($savePath, 0777, true);}
$isSuccess = uploadpicture( $form='up_file', $savepath=$savePath );

$err = $isSuccess['err'];
$pic = $isSuccess['file'];
$picname = $isSuccess['newName'];
$name = explode( ".", $picname );

if($err == 0){
	if( picIsDamage($pic, $name[1]) )	{//检查图片是否已经损坏
		$t1 = createthumb( $pic, $savepath, 800, 800, $name[0].'-b'); //创建800 * 800 缩略图
			if( $t1 === $pic ){ $t1 = $savePath.$name[0].'-b.'.$name[1]; rename( $pic, $t1 ); }
		$t2 = createthumb( $t1, $savepath, 440, 440, ($name[0].'-440') ); //创建440 * 440 缩略图
		$t3 = createthumb( $t2, $savepath, 240, 240, ($name[0].'-240') ); //创建240 * 240 缩略图
		$t4 = createthumb( $t3, $savepath, 160, 160, ($name[0].'-160') ); //创建160 * 160 缩略图
		$t5 = createthumb( $t4, $savepath, 100, 100, ($name[0].'-100') ); //创建100 * 100 缩略图
		if( file_exists($pic) )unlink($pic);
		$t1 = getonlyfilename( $savePath, $t1 );
		$t2 = getonlyfilename( $savePath, $t2 );
		$t3 = getonlyfilename( $savePath, $t3 );
		$t4 = getonlyfilename( $savePath, $t4 );
		$t5 = getonlyfilename( $savePath, $t5 );
		$success = true;
	}else{
		if( file_exists($pic) )unlink($pic);
		$success = false;
		$err = 11;
	}
}

$txt = urlencode(uploadmsg( $err ));
$pics = '';

if( $success ){ 
	$t = array();
	$t[] = $t1;
	$t[] = $t2;
	$t[] = $t3;
	$t[] = $t4;
	$t[] = $t5;
	$pics = implode(",",$t);
}

$url = "msgmulti.php?txt={$txt}&err={$err}&picpath={$savePath}&pics={$pics}&back=savemultifore";	
	
header("Location: {$url}");	//跳转时Location:后加一个空格

exit();
?>
