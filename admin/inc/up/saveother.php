<?php
require_once "../../../include/config.php";
require_once APP_ADM . "/inc/session.php";
require APP_PATH  . "/include/fn_post.php";
require APP_PATH . "/include/function.php";
require APP_PATH . "/include/cls_picture.php";
require APP_PATH . "/include/cls_thumbpic.php";

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


//============================================================================================================

$w = convert( getPost("w") );
$h = convert( getPost("h") );
$more	= convert( getPost("more") );
$w = is_numeric($w) ? intval($w) : 300;
$h = is_numeric($h) ? intval($h) : 400;
$success = false;
$newFolder = date("ymd",time());
$savePath = "../../../data/upload/other/";
if (!is_dir($savePath)) {mkdir($savePath, 0777, true);}
$isSuccess = uploadpicture( $form='up_file', $savepath=$savePath );

$err = $isSuccess['err'];
$pic = $isSuccess['file'];
$picname = $isSuccess['newName'];
$name = explode( ".", $picname );

if($err == 0){
	if( picIsDamage($pic, $name[1]) )	{//检查图片是否已经损坏
		$t1 = createthumb( $pic, $savepath, $w, $h, $name[0], 1); //创建缩略图
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
	$pics = frompicgetpath($t1);
}

$url = "msgother.php?txt={$txt}&err={$err}&picpath={$savePath}&pics={$pics}&w={$w}&h={$h}&more={$more}";	
	
header("Location: {$url}");	//跳转时Location:后加一个空格

exit();
?>
