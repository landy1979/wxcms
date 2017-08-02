<?php
require_once "../../../include/config.php";
require APP_PATH . "/include/fn_post.php";

$w = convert( geturl("w") );
$h = convert( geturl("h") );
$more = convert( geturl('more') );
$w = is_numeric($w) ? intval($w) : 300;
$h = is_numeric($h) ? intval($h) : 400;
$more = (!empty($more) && $more == "yes") ? "yes" : "no";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>单个文件上传</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function up(){
	var sw = "";
	var sh = "";
	var os = parent.document.getElementById("picwidth");
	var oh = parent.document.getElementById("picheight");
	if( os ) sw = os.value;	//图片宽
	if( oh ) sh = oh.value;	//图片高
	sw = (sw == "") ? 0 : parseInt(sw);
	sh = (sh == "") ? 0 : parseInt(sh);
	if( sw > 0 ){ document.getElementById("w").value = sw; }
	if( sh > 0 ){ document.getElementById("h").value = sh; }
	var _txt = document.getElementById("txt").value;
 	if( _txt == ""){
		alert("请选择要上传的文件!");
		return false;
 	}
	return true;
}
window.onload = function(){
	document.oncontextmenu = function(){return false};
}
</script>
</head>
<body>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="saveother.php" onsubmit="return(up())">
	<div class="d1"><input class="input_text" type="text" id="txt" name="txt" readonly="readonly" /></div>
	<div class="d2">
	<labal for="up_file" class="input_liulan">&nbsp;&nbsp;<img src="btn/browse.gif" /></labal>
	<input class="input_file" name="up_file" id="up_file" type="file" onKeyDown="return false" onChange="document.getElementById('txt').value=this.value" />
	</div>
	<div class="d3">
	<input type="image" src="btn/up.gif" name="button" id="button" />
	</div>
	<input type="hidden" name="w" id="w" value="<?php echo $w ?>" />
	<input type="hidden" name="h" id="h" value="<?php echo $h ?>" />
	<input type="hidden" name="more" id="more" value="<?php echo $more ?>" />
</form>
</body>
</html>