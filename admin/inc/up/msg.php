<?php 
$txt = $_GET['txt'];
$err = $_GET['err'];
$pic = $_GET['pic'];
$err = intval( $err );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="color:#F60; padding:5px 0px;">
	<?php
		echo $txt;
		if( $err == 0 ){ echo "&nbsp;&nbsp;<a href='{$pic}' target='_blank' style='color:#F60;'>".str_replace('../','',$pic)."</a>"; }
	?>
	&nbsp;&nbsp;<a href="upload.php?postfile=saveone.php" style="color:#F60;">重新上传</a>
</div>
<script type="text/javascript">
	var err = <?php echo $err; ?>;
	if( err == 0 ) parent.document.getElementById("logo").value = "<?php echo $pic ?>";
</script>
</body>
</html>