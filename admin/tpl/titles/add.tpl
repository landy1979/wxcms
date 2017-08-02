<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加职称</title>
<link href="{{$APP_ADM}}/css/common.css"  rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>

<body>

<div class="tab_navigator">
	<span>职称信息</span>
</div>

<form name="form" id="form" method="post">
<div class="container">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
		<tr>
    	<td class="label" width="8%">医生职称：</td>
	    <td><input type="text" name="titlename" id="titlename" size="30" class="form-input"><span class="required">*</span></td>
    </tr>
    <tr>
    	<td class="label">预约费用：</td>
      <td><input type="text" name="cost" id="cost" size="30" class="form-input" /> 元 (四舍五入后保留2位小数)<span class="required">*</span></td>
		</tr>
    <tr>
    	<td style="padding:5px 20px;"><input type="submit" name="btn_submit" class="btn btn-pri" value="提交" /></td>
		</tr>
	</table>
	<div id="msg" class="msgbox"></div>
</div>

</form>

<script src="{{$APP_PATH}}/js/jquery-1.11.3.min.js"></script>
<script src="{{$APP_PATH}}/js/jquery.form.js"></script>
<script src="{{$APP_ADM}}/js/jquery.ready.js"></script>
<script src="{{$APP_PATH}}/js/layer/layer.js"></script>
<script src="{{$APP_PATH}}/js/layer/layui/layui.js"></script>
<script src="js/titles.js"></script>

</body>
</html>