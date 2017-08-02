<?php
//==========================================
//�ȱ�������ָ���ߴ�����ͼ��֧��gif,jpg,bmp,png
//==========================================
class scaleZoomImage{
	public $oImName;//ԭʼͼƬ�ļ���
	public $newImgPath;//����ͼ���·��
	public $newWidth;
	public $newHeight;
	public $bgcolor;
	public function __construct($_oImName){
		$this->oImName = $_oImName;//��ͼ�ļ���,����·�������·��
		$this->bgcolor = "#ffffff"; //����ɫĬ�ϰ�ɫ
	}
	public function getImgSize(){
		$oSize = getimagesize( $this->oImName);//���ͼƬ���,��������
		return $oSize;
	}
	public function createThumb(){
		$ran = date("ymdHis") . mt_rand(0, 99) ;
		$newimagename = $this->newImgPath . $ran;
		$oldSize = $this->getImgSize();
		$oW = $oldSize[0];//ԭͼ��
		$oH = $oldSize[1];//ԭͼ��
		$ext = $oldSize[2];//��չ��
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
		//===========��������ͼ===================
		if ($oW / $thumb_width > $oH / $thumb_height){
            $lessen_width  = $thumb_width;
            $lessen_height  = $thumb_width / $scale_org;
        }
        else{
            /* ԭʼͼƬ�Ƚϸߣ����Ը߶�Ϊ׼ */
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
	getimagesize�������ص��ļ�����:
	1 = GIF��2 = JPG��3 = PNG��4 = SWF��5 = PSD
	6 = BMP��7 = TIFF(intel byte order)��8 = TIFF(motorola byte order)
	9 = JPC��10 = JP2��11 = JPX��12 = JB2��13 = SWC
	14 = IFF��15 = WBMP��16 = XBM
	*/
}


/* ����ʵ��
$oPic = "../uploadfile/71.jpg"; //ԭͼ
$oImage = new scaleZoomImage($oPic);
$oImage->newImgPath = "../uploadfile/zoom/"; //����ͼ���·��
$oImage->newWidth  = 300; //����ͼ���
$oImage->newHeight = 300; //����ͼ�߶�
$oImage->bgcolor = "#ffccbb"; //����ͼ����ɫ
$oImage->createThumb(); //��������ͼ,����ȱ�������
unset($oImage);	//�ͷŶ���
 */



/* ͼƬˮӡ, ��֧����������,��ˮӡͼ��֧��gif,png  */
class imgWatermark{
	public  $imgSrc; //Ҫ��ˮӡ��ͼƬ
	public  $waterType;	//ˮӡ����,0���֣�1ͼƬ
	public  $waterText; //ˮӡ����
	public  $waterTextColor; //ˮӡ������ɫ
	public  $logoImage; //СˮӡͼƬ,ͨ��Ϊlogo
	private $isFile;
	private $err;
	
	public function __construct($_src){
		if(file_exists($_src)){
			$this->imgSrc = $_src;
			$this->isFile = true;
			$this->waterType = 0; //ˮӡĬ��0Ϊ����,1ΪͼƬ
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
			case 0:		/* ����ˮӡ */
				$color = trim( $this->waterTextColor, "#" );
				sscanf($color, "%2x%2x%2x", $red, $green, $blue);
				$textcolor = imagecolorallocate($wim, $red, $green, $blue);
				$text = iconv('GB2312','UTF-8',$this->waterText);//�����ַ�תΪutf
				$textArea = imagettfbbox ( ceil( 5 * 2.5), 0, "font/arial.ttf", $text );
				$text_w = $textArea[2] - $textArea[0];
				$text_h = $textArea[3] - $textArea[5];
				$pos_x = ($img_w - $text_w) - 20;
				$pos_y = ($img_h - $text_h) - 20;
				imagestring($wim, 5, $pos_x, $pos_y, $text, $textcolor);
				//ImageTTFText($wim,15,0,$pos_x,$pos_y,$textcolor,"font/arial.ttf",$text);
				imagejpeg($wim,null,100);
				break;
			case 1: 		/* ͼƬˮӡ */
				if( file_exists($this->logoImage) ){
					$sinfo = getimagesize($this->logoImage);
					$small_w = $sinfo[0];
					$small_h = $sinfo[1];
					$logo_type = $sinfo[2];
					unset($sinfo);
					$dst_x = ($img_w - $small_w) - 10;
					$dst_y = ($img_h - $small_h) - 5;
					switch ($logo_type){ //����ˮӡ�ļ�����(gif,png��)��ִ����Ӧ�Ĳ���
						case 1 : 
							$logo = imagecreatefromgif( $this->logoImage ); //Gif
							imagecopymerge($wim,$logo,$dst_x,$dst_y,0,0,$small_w,$small_h,100); //Gif
							break;
						case 3 :
							$logo = imagecreatefrompng( $this->logoImage); //png
							imagecopy($wim,$logo,$dst_x,$dst_y,0,0,$small_w,$small_h); //png
							break;
					}

					imagejpeg($wim,null,100); //��ҳ�����ͼƬ
					
					//���ݲ�ͬ����ͼƬִ����Ӧ�ı��溯��,��ͼ����ˮӡ��ͼƬ
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

/* ����ʵ�� */
//header("Content-type: image/jpeg");
//$wPic = "../uploadfile/2005101713401776.jpg";
//$water = new imgWatermark($wPic);
//$water->waterType = 1;
//$water->logoImage = "font/ry.png";
//$water->addWatermark();
//unset($water);
?>