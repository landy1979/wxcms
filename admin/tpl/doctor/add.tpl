<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加医生信息</title>
<link href="{{$APP_ADM}}/css/common.css"  rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
<!-- kindeditor -->
<script charset="utf-8" src="{{$APP_PATH}}/include/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="{{$APP_PATH}}/include/kindeditor/lang/zh_CN.js"></script>
<!-- kindeditor -->
</head>

<body>

<form name="form" id="form" method="post">
<input type="hidden" name="logo" id="logo" value="" />
<select id="pcat" style="display:none;"><option value="0">0</option></select>
<input type="hidden" name="depid" id="depid" value="{{$depid}}" />
<div class="tab_navigator">
	<span>医生信息</span>
</div>

<div class="container">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
		<tr>
  	 	<td class="label" width="8%">医生姓名：</td>
	    <td><input type="text" name="docname" id="docname" size="30" class="form-input"><span class="required">*</span></td>
    </tr>
    {{if $depid eq 0}}
    <tr>
    	<td class="label">所在科室：</td>
      <td>
      	<select name="depart" id="depart" class="form-input">
        	{{foreach from=$depart item=value}}
          <option value="{{$value.id}}">{{$value.depname}}</option>
          {{/foreach}}
        </select>
      </td>
    </tr>
    {{/if}}
    <tr>
     	<td class="label">联系电话：</td>
      <td><input type="text" name="phone" id="phone" size="30" class="form-input" /></td>
		</tr>
    <tr>
    	<td class="label">所属职务：</td>
      <td>
      	<select name="title" id="title" class="form-input">
      		{{foreach from=$titles item=value}}
					<option value="{{$value.id}}">{{$value.titname}}</option>
       		{{/foreach}}
        </select><span class="required">*</span>
      </td>
		</tr>
    <tr>
     	<td class="label">医生头像：</td>
      <td><iframe src="{{$APP_ADM}}/inc/up/upload.php?postfile=saveone.php" width="100%" height="24" frameborder="0" scrolling="no" id="upfile"></iframe></td>
    </tr>
    <tr>
    	<td class="label" valign="top">医生简介：</td>
    	<td><textarea name="content" id="content" style="width:80%;height:300px;visibility:hidden;" class="form-textarea "></textarea></td>
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
<script src="js/doctor.js"></script>
<script>
//=====================================
//KindEditor
var editor;
KindEditor.ready(function(K){
	editor = K.create("textarea[name=content]", {
		resizeType: 1,
		allowImageUpload: true,
		allowFileManager : true,
		items: [
			'fontname', 'fontsize', '|', 'forcecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link'
		],
		afterBlur: function() { this.sync(); }
	});
});
</script>
</body>
</html>