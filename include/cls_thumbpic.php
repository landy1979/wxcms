<?php
//==========================================
//等比例生成指定尺寸缩略图，支持gif,jpg,bmp,png
//==========================================

class scaleZoomImage{
	public $oImName;//原始图片文件名
	public $newImgPath;//缩略图存放路径
	public $newWidth;
	public $newHeight;
	public $bgcolor;
	public $mode = 0;	/* 生成缩略图方式：0为等比例缩放，1为以宽为标准缩放，2为以高为标准缩放 */
	public function __construct(){
		$this->bgcolor = "#ffffff"; //背景色默认白色
	}

	public function createThumb( $picnewname ){
		if( !isset($picnewname)){
			$ran = date("ymdHis") . mt_rand(0, 99) ;
			$newimagename = $this->newImgPath . $ran;
		}else {
			$newimagename = $this->newImgPath . $picnewname;
		}
		$oldSize = @getimagesize( $this->oImName);//获得图片宽高,返回数组;
		$oW = $oldSize[0];//原图宽
		$oH = $oldSize[1];//原图高
		if($oW < $this->newWidth && $oH < $this->newHeight){return $this->oImName;}
		$ext = $oldSize[2];//扩展名
		switch ($ext) {
			case 1:	$ex = ".gif"; break;
			case 2: $ex = ".jpg"; break;
			case 3: $ex = ".png"; break;
			case 6: $ex = ".bmp"; break;
			default: $ex = ".jpg";
		}
		$thumb_width  = $this->newWidth;
		$thumb_height = $this->newHeight;
		//if($oW<$thumb_width && $oH < $thumb_height){copy($this->oImName,($newimagename.=$ex));return $newimagename.=$ex;}
		
		//===========计算缩略图===================
		$nw = $oW;
		$nh = $oH;

		switch ( $this->mode ){
			case 1 : 	if( $oW >= $thumb_width ){
        					$nw = $thumb_width;
        					$nh = intval($oH * ( $thumb_width / $oW ));
        				}			
						break;
			case 2 :	if( $oH >= $thumb_height ){
        					$nh = $thumb_height;
        					$nw = intval( $oW * ( $thumb_height / $oH ) );
        				}
        				break;
        	default :
        			if( $oW >= $thumb_width ){
        				$nw = $thumb_width;
        				$nh = intval($oH * ( $thumb_width / $oW ));
        			}
        			if( $oH >= $thumb_height ){
        				$nh = $thumb_height;
        				$nw = intval( $oW * ( $thumb_height / $oH ) );
        			}
		}
		//==============================
		$im  = imagecreatetruecolor($nw, $nh);
		//$bgColor = trim($this->bgcolor,"#");
		//sscanf($bgColor, "%2x%2x%2x", $red, $green, $blue);
		//$bgColor = ImageColorAllocate($im, $red,$green,$blue);
		//imagefilledrectangle($im, 0, 0, $nw, $nh, $bgColor);
		switch ($ext) {
			case 1:	$oim = @imagecreatefromgif($this->oImName);		$newimagename .= ".gif"; break;
			case 2: $oim = @imagecreatefromjpeg($this->oImName);	$newimagename .= ".jpg"; break;
			case 3: $oim = @imagecreatefrompng($this->oImName);		$newimagename .= ".png"; break;
			case 6: $oim = @imagecreatefromwbmp($this->oImName);	$newimagename .= ".bmp"; break;
		}
		imagecopyresampled($im, $oim, 0, 0, 0, 0, $nw, $nh, $oW, $oH);
		$ims = null;
		switch ( $this->mode ){
			case 1 :	$y = 0;
						if( $nh > $thumb_height ){
							$y = intval( ($nh - $thumb_height) / 2 );
							$ims = imagecreatetruecolor($thumb_width, $thumb_height);
							$white = imagecolorallocate($ims, 255, 255, 255);
							imagefill($ims, 0, 0, $white);
							$copyWidth = $nw >= $thumb_width ? $thumb_width : $nw;
							imagecopy ( $ims, $im, 0, 0, 0, $y, $copyWidth, $thumb_height );
						}else {
							$ims = $im;
						}
						
						break;
			case 2 :	if( $nw > $thumb_width ){
							$x = intval( ($nw - $thumb_width ) / 2 );
							$ims = imagecreatetruecolor($thumb_width, $thumb_height);
							$white = imagecolorallocate($ims, 255, 255, 255);
							imagefill($ims, 0, 0, $white);
							$copyHeight = $nh >= $thumb_height ? $thumb_height : $nh;
							imagecopy ( $ims, $im, 0, 0, $x, 0, $thumb_width, $copyHeight );
						}else {
							$ims = $im;
						}
						break;
		}
		if( $this->mode == 0 ){
			switch ($oldSize[2]){
				case 1:	imagegif($im, $newimagename, 100);	break;
				case 2: imagejpeg($im, $newimagename, 100);	break;
				case 3: imagepng($im, $newimagename, 9);	break;
				case 6: imagewbmp($im, $newimagename, 100);	break;
			}			
		}else {
			if( !is_null($ims) ){
				switch ($oldSize[2]){
					case 1:	imagegif($ims, $newimagename, 100);	break;
					case 2: imagejpeg($ims, $newimagename, 100);	break;
					case 3: imagepng($ims, $newimagename, 9);	break;
					case 6: imagewbmp($ims, $newimagename, 100);	break;
				}
			}			
		}		

		return $newimagename;
	}
	/*
	getimagesize函数返回的文件类型:
	1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD
	6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)
	9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC
	14 = IFF，15 = WBMP，16 = XBM
	*/
}


/* 调用实例
$oPic = "../uploadfile/71.jpg"; //原图
$oImage = new scaleZoomImage();
$oImage->oImName = $oPic;
$oImage->newImgPath = "../uploadfile/zoom/"; //缩略图存放路径
$oImage->newWidth  = 300; //缩略图宽度
$oImage->newHeight = 300; //缩略图高度
$oImage->createThumb(); //创建缩略图,按宽等比例缩放
unset($oImage);	//释放对象
*/





/* ========================================================================================== */

/* 水印 */
/* 图片水印, 支持中文文字,做水印图仅支持gif,jpg,png  */
class imgWatermark{
	public  $imgSrc; //要加水印的图片
	public  $waterType;	//水印类型,0文字，1图片
	public  $waterText; //水印文字
	public  $waterTextColor; //水印文字颜色
	public	$waterTextSize;
	public	$waterFont;
	public  $logoImage; //小水印图片,通常为logo
	public	$custom;  //是否自定义水印位置
	public  $customLeft, $customTop;
	public  $customW, $customH; //水印图片宽高
	public  $tmpPath, $tmpFile;			//如果有水印图片过大，缩放成目标水印大小时存放过度图片的文件夹路径
	private $isFile;
	private $err;
	
	public function __construct($_src){
		if(file_exists($_src)){
			$this->imgSrc = $_src;
			$this->isFile = true;
			$this->waterType = 0; //水印默认0为文字,1为图片
			$this->waterText = "";
			$this->waterTextColor = "#ffffff";
			$this->waterTextSize = 12;
			$this->waterFont = "font/simhei.ttf";
			$this->custom = 0; //默认0为不自定义，1为自定义
			$this->customLeft = 0;
			$this->customTop = 0;
			$this->tmpPath = str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/"; //如果有水印图片过大，缩放成目标水印大小时存放过度图片的文件夹路径
			$this->tmpFile = "";
		}else{
			$this->err = 0;
		}
	}
	
	public function addWatermark(){
		$info = getimagesize($this->imgSrc);
		$img_w = $info[0];
		$img_h = $info[1];
		$wim = $this->openimage($info[2]);
		if( !$wim )return ;
		switch ($this->waterType){
			case 0:		/* 文字水印 */
				$color = trim( $this->waterTextColor, "#" );
				sscanf($color, "%2x%2x%2x", $red, $green, $blue);
				$textcolor = imagecolorallocate($wim, $red, $green, $blue);
				//$text = iconv('GB2312','UTF-8',$this->waterText);//中文字符转为utf
				$text = $this->waterText;
				$textArea = imagettfbbox ( ceil( 5 * 2.5), 0, $this->waterFont, $text );
				$text_w = $textArea[2] - $textArea[0];
				$text_h = $textArea[3] - $textArea[5];
				if( $this->custom == 1 ){
					$pos_x = $this->customLeft;
					$pos_y = $this->customTop;
				}else {
					$pos_x = ($img_w - $text_w) - 20;
					$pos_y = ($img_h - $text_h) - 20;
				}
				//imagestring($wim, 5, $pos_x, $pos_y, $text, $textcolor);
				ImageTTFText($wim,$this->waterTextSize,0,$pos_x,$pos_y,$textcolor,$this->waterFont,$text);
				//imagejpeg($wim,null,100);
				imagejpeg($wim,$this->imgSrc,100);
				break;
			case 1: 		/* 图片水印 */
				if( file_exists($this->logoImage) ){
					$sinfo = getimagesize($this->logoImage);
					$small_w = $sinfo[0];
					$small_h = $sinfo[1];
					$logo_type = $sinfo[2];
					unset($sinfo);
					//如果使用自定义水印位置
					if( $this->custom == 1 ){
						$dst_x = $this->customLeft;
						$dst_y = $this->customTop;
						if( $small_w > $this->custom ){
							$oPic = $this->logoImage; //原大水印图标
							$oImage = new scaleZoomImage();
							$oImage->oImName = $oPic;
							$oImage->newImgPath = $this->tmpPath; //缩略图存放路径
							$oImage->newWidth  = $this->customW; //缩略图宽度
							$oImage->newHeight = $this->customH; //缩略图高度
							$this->tmpFile = $oImage->createThumb(null); //创建缩略图,按宽等比例缩放
							$this->logoImage = $this->tmpFile;
							unset($oImage);	//释放对象						
						}
						$small_w = $this->customW;
						$small_h = $this->customH;
					}else {
						$dst_x = ($img_w - $small_w) - 10;
						$dst_y = ($img_h - $small_h) - 5;
					}
					switch ($logo_type){ //根据水印文件类型(gif,jpg,png等)，执行相应的操作
						case 1 : 
							$logo = imagecreatefromgif( $this->logoImage ); //Gif
							imagecopymerge($wim,$logo,$dst_x,$dst_y,0,0,$small_w,$small_h,100); //Gif
							break;
						case 2 :
							$logo = imagecreatefromjpeg( $this->logoImage );
							imagecopymerge($wim,$logo,$dst_x,$dst_y,0,0,$small_w,$small_h,100); //jpg
							break;
						case 3 :
							$logo = imagecreatefrompng( $this->logoImage); //png
							imagecopy($wim,$logo,$dst_x,$dst_y,0,0,$small_w,$small_h); //png
							break;
					}

					
					
					//根据不同类型图片执行相应的保存函数,保存加了水印的图片
					imagejpeg($wim,$this->imgSrc,100);
					
					if( file_exists($this->tmpFile) )unlink($this->tmpFile); //如果有临时缩略图文件，删除
					
					//imagejpeg($wim,null,100); //在页面输出图片
				}
				break;
		}
		ImageDestroy($wim); //结束图形，释放内存空间
	}
	
	private function openimage($_info){
		$im = null;
		switch ($_info){
			case 1:	$im = imagecreatefromgif( $this->imgSrc );  break; // gif
			case 2: $im = imagecreatefromjpeg( $this->imgSrc ); break; //jpg
			case 3: $im = imagecreatefrompng( $this->imgSrc ); break; // png
			case 6: $im = imagecreatefromwbmp( $this->imgSrc ); break;
		}
		return $im;
	}
	
}

/* 图片水印结束 */


?>