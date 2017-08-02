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
	public function __construct($_oImName){
		$this->oImName = $_oImName;//大图文件名,绝对路径或相对路径
		$this->bgcolor = "#ffffff"; //背景色默认白色
	}
	public function getImgSize(){
		$oSize = getimagesize( $this->oImName);//获得图片宽高,返回数组
		return $oSize;
	}
	public function createThumb(){
		$ran = date("ymdHis") . mt_rand(0, 99) ;
		$newimagename = $this->newImgPath . $ran;
		$oldSize = $this->getImgSize();
		$oW = $oldSize[0];//原图宽
		$oH = $oldSize[1];//原图高
		$ext = $oldSize[2];//扩展名
		switch ($ext) {
			case 1:	$ex = ".gif"; break;
			case 2: $ex = ".jpg"; break;
			case 3: $ex = ".png"; break;
			case 6: $ex = ".bmp"; break;
			default: $ex = ".jpg";
		}
		$scale_org = $oW / $oH ;
		$thumb_width  = $this->newWidth;
		$thumb_height = $this->newHeight;
		if($oW<$thumb_width && $oH < $thumb_height){copy($this->oImName,($newimagename.=$ex));return ;}
		//===========计算缩略图===================
		if ($oW / $thumb_width > $oH / $thumb_height){
            $lessen_width  = $thumb_width;
            $lessen_height  = $thumb_width / $scale_org;
        }
        else{
            /* 原始图片比较高，则以高度为准 */
            $lessen_width  = $thumb_height * $scale_org;
            $lessen_height = $thumb_height;
        }
        $dst_x = ($thumb_width  - $lessen_width)  / 2;
        $dst_y = ($thumb_height - $lessen_height) / 2;
		//==============================
		$im  = imagecreatetruecolor($this->newWidth, $this->newHeight);
		$bgColor = trim($this->bgcolor,"#");
		sscanf($bgColor, "%2x%2x%2x", $red, $green, $blue);
		$bgColor = ImageColorAllocate($im, $red,$green,$blue);//
		imagefilledrectangle($im, 0, 0, $this->newWidth, $this->newHeight, $bgColor);
		switch ($ext) {
			case 1:	$oim = imagecreatefromgif($this->oImName);  $newimagename .= ".gif"; break;
			case 2: $oim = imagecreatefromjpeg($this->oImName); $newimagename .= ".jpg"; break;
			case 3: $oim = imagecreatefrompng($this->oImName);  $newimagename .= ".png"; break;
			case 6: $oim = imagecreatefrompng($this->oImName);  $newimagename .= ".bmp"; break;
			default: return;
		}
		imagecopyresampled($im, $oim, $dst_x, $dst_y, 0, 0, $lessen_width, $lessen_height, $oW, $oH);
		switch ($oldSize[2]){
			case 1:	imagegif($im, $newimagename, 100);	break;
			case 2: imagejpeg($im, $newimagename, 100);	break;
			case 3: imagepng($im, $newimagename, 100);	break;
			case 6: imagewbmp($im, $newimagename, 100);	break;			
		}
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
$oImage = new scaleZoomImage($oPic);
$oImage->newImgPath = "../uploadfile/zoom/"; //缩略图存放路径
$oImage->newWidth  = 300; //缩略图宽度
$oImage->newHeight = 300; //缩略图高度
$oImage->bgcolor = "#ffccbb"; //缩略图背景色
$oImage->createThumb(); //创建缩略图,按宽等比例缩放
unset($oImage);	//释放对象
 */



/* 图片水印, 不支持中文文字,做水印图仅支持gif,png  */
class imgWatermark{
	public  $imgSrc; //要加水印的图片
	public  $waterType;	//水印类型,0文字，1图片
	public  $waterText; //水印文字
	public  $waterTextColor; //水印文字颜色
	public  $logoImage; //小水印图片,通常为logo
	private $isFile;
	private $err;
	
	public function __construct($_src){
		if(file_exists($_src)){
			$this->imgSrc = $_src;
			$this->isFile = true;
			$this->waterType = 0; //水印默认0为文字,1为图片
			$this->waterText = "www.me.com";
			$this->waterTextColor = "#ffffff";
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
				$text = iconv('GB2312','UTF-8',$this->waterText);//中文字符转为utf
				$textArea = imagettfbbox ( ceil( 5 * 2.5), 0, "font/arial.ttf", $text );
				$text_w = $textArea[2] - $textArea[0];
				$text_h = $textArea[3] - $textArea[5];
				$pos_x = ($img_w - $text_w) - 20;
				$pos_y = ($img_h - $text_h) - 20;
				imagestring($wim, 5, $pos_x, $pos_y, $text, $textcolor);
				//ImageTTFText($wim,15,0,$pos_x,$pos_y,$textcolor,"font/arial.ttf",$text);
				imagejpeg($wim,null,100);
				break;
			case 1: 		/* 图片水印 */
				if( file_exists($this->logoImage) ){
					$sinfo = getimagesize($this->logoImage);
					$small_w = $sinfo[0];
					$small_h = $sinfo[1];
					$logo_type = $sinfo[2];
					unset($sinfo);
					$dst_x = ($img_w - $small_w) - 10;
					$dst_y = ($img_h - $small_h) - 5;
					switch ($logo_type){ //根据水印文件类型(gif,png等)，执行相应的操作
						case 1 : 
							$logo = imagecreatefromgif( $this->logoImage ); //Gif
							imagecopymerge($wim,$logo,$dst_x,$dst_y,0,0,$small_w,$small_h,100); //Gif
							break;
						case 3 :
							$logo = imagecreatefrompng( $this->logoImage); //png
							imagecopy($wim,$logo,$dst_x,$dst_y,0,0,$small_w,$small_h); //png
							break;
					}

					imagejpeg($wim,null,100); //在页面输出图片
					
					//根据不同类型图片执行相应的保存函数,保图加了水印的图片
					//imagejpeg($wim,$this->imgSrc,100);
					
					}
				break;
		}
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

/* 调用实例 */
//header("Content-type: image/jpeg");
//$wPic = "../uploadfile/2005101713401776.jpg";
//$water = new imgWatermark($wPic);
//$water->waterType = 1;
//$water->logoImage = "font/ry.png";
//$water->addWatermark();
//unset($water);
?>