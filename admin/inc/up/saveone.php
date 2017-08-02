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
$fooler = "data/upload/logo/";
$savePath = '../../../' . $fooler;
$isSuccess = uploadpicture( $form='up_file', $savepath=$savePath );
$txt = urlencode(uploadmsg( $isSuccess['err'] ));
$err = $isSuccess['err'];
$p = explode( ".", $isSuccess['newName'] );
$pic = "c_" . $p[0];
$oldName = $savePath . $isSuccess['newName'];
//$newName = createthumb( $oldName, $savePath, 720, 330, $pic, 1);
$newName = $isSuccess['file'];
//if( file_exists($isSuccess['file']) )unlink($isSuccess['file']); //删除原图
$url = "msg.php?txt={$txt}&err={$err}&pic={$newName}";
header("Location: {$url}");	//跳转时Location:后加一个空格
exit();
?>
