<?php
require_once "../../../include/config.php";
require_once APP_ADM . "/inc/session.php";
$post_file = $_GET['postfile'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>单个文件上传</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function up(){
	if("<?=$post_file ?>" != "saveone.php"){
		var oCat = parent.document.getElementById("pcat");
		var Index = oCat.selectedIndex;
		if( Number(Index) == 0 ){
			alert("请先选择栏目后再上传图片！");
			return false;
		}
	}
	document.getElementById("catId").value = oCat.options[Index].value;
	var _txt = document.getElementById("txt").value;
 	if( _txt == ""){
		alert("请选择要上传的文件!");
		return false;
 	}
	return true;
}
window.onload = function(){
//	document.oncontextmenu = function(){return false};
}
</script>
</head>
<body>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="<?php echo $post_file ?>" onsubmit="return(up())">
	<input type="hidden" name="catId" id="catId" value="0" />
	<div class="d1"><input class="input_text" type="text" id="txt" name="txt" readonly="readonly" /></div>
	<div class="d2">
	<labal for="up_file" class="input_liulan">&nbsp;&nbsp;<img src="btn/browse.gif" /></labal>
	<input class="input_file" name="up_file" id="up_file" type="file" onKeyDown="return false" onChange="document.getElementById('txt').value=this.value" />
	</div>
	<div class="d3">
	<input type="image" src="btn/up.gif" name="button" id="button" />
	</div>
</form>
</body>
</html>