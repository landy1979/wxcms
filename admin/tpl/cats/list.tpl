<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目列表</title>
<link href="{{$APP_ADM}}/css/common.css" rel="stylesheet" />
<link href="css/cats.css" rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>
<body>

<div class="tab_navigator">
	<span>栏目列表</span>
</div>

<div class="container" style="margin:0; border:0">
  <table border="0" width="100%" cellspacing="1" cellpadding="3" align="center" bgcolor="#efefef" style="margin-top:10px;">
  	<tr style="border-bottom:1px solid #BCBCBC;">
    	<td height="28"><h3>网站栏目管理</h3></td>
		</tr>
    <tr>
    	<td>
	  	<form name="list" id="list" method="post">
			{{$list}}
  		</form>
			</td>
		</tr>
	</table>                
</div>

<script src="{{$APP_PATH}}/js/jquery-1.11.3.min.js"></script>
<script src="{{$APP_PATH}}/js/jquery.form.js"></script>
<script src="{{$APP_PATH}}/js/layer/layer.js"></script>
<script src="{{$APP_PATH}}/js/layer/layui/layui.js"></script>
<script src="{{$APP_ADM}}/js/jquery.ready.js"></script>

</body>
</html>