<?php
/* 水印 */
/* 图片水印, 支持中文文字,做水印图仅支持gif,jpg,png  */
class imgWatermark{
	public  $imgSrc; //要加水印的图片
	public  $waterType;	//水印类型,0文字，1图片
	public  $waterText; //水印文字
	public  $waterTextColor; //水印文字颜色
	public	$waterTextSize;
	public  $logoImage; //小水印图片,通常为logo
	public	$custom;  //是否自定义水印位置
	public  $customLeft, $customTop;
	public  $customW, $customH; //水印图片宽高
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
			$this->custom = 0; //默认0为不自定义，1为自定义
			$this->customLeft = 0;
			$this->customTop = 0;
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
				$textArea = imagettfbbox ( ceil( 5 * 2.5), 0, "font/simhei.ttf", $text );
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
				ImageTTFText($wim,$this->waterTextSize,0,$pos_x,$pos_y,$textcolor,"font/simhei.ttf",$text);
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

					imagejpeg($wim,null,100); //在页面输出图片
					
					//根据不同类型图片执行相应的保存函数,保图加了水印的图片
					imagejpeg($wim,$this->imgSrc,100);
					
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

function emojistr( $urlencode_str ){
	$str = urldecode( $urlencode_str );
	$str = json_encode($str); //暴露出unicode
	$str = preg_replace("#(\\\ue[0-9a-f]{3})#ie","addslashes('\\1')",$str); //将emoji的unicode留下，其他不动
	$str = json_decode($str);
	return $str;
}
	
	
/* 调用实例 */
header('Content-type: text/html; charset=UTF-8');
header("Content-type: image/jpeg");

$bg = "../data/weixin/qrcode/senior/tpl.jpg";
$tmp = "../data/weixin/qrcode/senior/" . date("YmdHis") . mt_rand(0, 99999999) . ".jpg";
$head = "../data/weixin/qrcode/senior/head.jpg";
if ( copy( $bg, $tmp ) ) {
	$wPic = $tmp;
	$water = new imgWatermark($wPic);
	/* 头像水印到背景图上 开始 */
		$water->waterType = 1;				//图片水印
		$water->logoImage = $head;
		$water->custom = 1;					//自定义水印图片位置
		$water->customLeft = 50;			//水印图片离左部距离
		$water->customTop = 40;				//水印图片离上部距离
		$water->customW = 55;				//水印图片宽度
		$water->customH = 55;				//水印图片高度
		$water->addWatermark();
	/* 头像水印到背景图上 结束 */
	/* 昵称水印到背景图上 开始 */
		$nick = "%E3%80%8E%E6%9F%94%E5%92%8C%E8%8C%85%E5%8F%B0%E9%86%87%E3%80%8F"; //已url编码的昵称
		$nick = urldecode($nick);		//url解码
		
	/* 昵称水印到背景图上 结束 */
	unset($water);
	
	
};

echo "ok";

?>