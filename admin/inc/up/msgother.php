<?php
require( "../../../config.php" );
require( "../ck_sessiong.php" );
require( "../../../include/fn_post.php" );
$txt = convert(geturl('txt'));
$err = convert(geturl('err'));
$picpath = convert(geturl('picpath'));
$pics = convert(geturl('pics'));
$w	= convert(geturl('w'));
$h  = convert(geturl('h'));
$more	= convert(geturl('more'));
$err = intval( $err );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div style="color:#F60; padding:5px 0px;">
	<?php
		echo $txt;
		if( $err == 0 ){ 
			$photos = explode( ",", $pics );
			$pic = $picpath . $photos[0];
			echo "&nbsp;&nbsp;<a href='{$pic}' target='_blank' style='color:#F60;'>".str_replace('../','',$pic)."</a>";
		}
		if( $more == "yes" ){
			$continuestr = "&nbsp;&nbsp;<a href=\"uploadother.php?w={$w}&h={$h}&more={$more}\" style=\"color:#F60;\">继续上传</a>	";
			echo $continuestr;
			
			
		}
	?>
</div>
<script type="text/javascript">
	var err = <?php echo $err; ?>;
	if( err == 0 ){
		var multi_up = parent.document.getElementById("multi_up");
		var pic_area = $(multi_up);
		var order = pic_area.find("img").size() + 1;
		var path = "<?php echo $picpath ?>";
		path = path.replace(/\.\.\//g,"");
		path = "<?php echo SITE_URL ?>" + path;
		var pics = "<?php echo $pics ?>";
		var pic = pics.split(",");
		var len = pic.length;
		var src = pic[len-1];
		src = path + src;
		var div = $("<div class='uppic' data-path='<?php echo str_replace('../','',$picpath) ?>' data-pics='<?php echo $pics ?>' data-order=''></div>");
		var img = $("<img src="+src+" />");
		img.css({ width:'100%', height:'auto' });
		var _del = $("<div class='delPic' title='删除图片' onClick='deleteuppic(this)'></div>");
		div.appendTo(pic_area);
		img.appendTo( div );
		_del.appendTo(div);
		div.attr("data-order",order);
		
	}
</script>
</body>
</html>