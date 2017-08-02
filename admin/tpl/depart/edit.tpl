<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加科室</title>
<link href="{{$APP_ADM}}/css/common.css"  rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
<!-- kindeditor -->
<script charset="utf-8" src="{{$APP_PATH}}/include/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="{{$APP_PATH}}/include/kindeditor/lang/zh_CN.js"></script>
<!-- kindeditor -->
</head>

<body>

<form name="form" id="form" method="post">
<input type="hidden" name="logo" id="logo" value="{{$res.pic}}" />
<input type="hidden" name="depid" id="depid" value="{{$res.id}}" />
<select id="pcat" style="display:none;"><option value="0">0</option></select>
<div class="layui-tab layui-tab-card" lay-filter="demo">
	<ul class="layui-tab-title">
  	<li class="layui-this">科室信息</li>
    <li>科室内容</li>
  </ul>
  <div class="layui-tab-content container">
    <div class="layui-tab-item layui-show">
    	<div class="item-content">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
       		<tr>
          	<td class="label" width="8%">科室名称：</td>
	          <td colspan="2"><input type="text" name="depname" id="depname" size="30" class="form-input" value="{{$res.depname}}"><span class="required">*</span></td>
        	</tr>
          <tr>
          	<td class="label">联系电话：</td>
            <td colspan="2"><input type="text" name="phone" id="phone" size="30" class="form-input" value="{{$res.phone}}" /></td>
					</tr>
          <tr>
          	<td class="label">科室地址：</td>
            <td colspan="2"><input type="text" name="address" id="address" class="form-input" size="40" value="{{$res.address}}" /></td>
					</tr>
          <tr>
          	<td class="label">科室图片：</td>
            <td width="30%"><iframe src="{{$APP_ADM}}/inc/up/upload.php?postfile=saveone.php" width="100%" height="24" frameborder="0" scrolling="no" id="upfile"></iframe></td>
            <td>
            {{if $res.pic}}
           	<div class="uppic" data-path="{{$res.pic}}" style="width:80px;">
	         		<img src="{{$res.pic}}" style="width: 100%; height: auto;" />
            </div>
            {{/if}}
            </td>
          </tr>
          <tr>
          	<td class="label">简短描述：</td>
            <td colspan="2"><textarea name="shortcontent" id="shortcontent"  rows="4" cols="70">{{$res.shortcontent}}</textarea></td>
					</tr>
				</table>
      </div>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
      	<tr>
        	<td><textarea name="content" id="content" style="width:80%;height:500px;visibility:hidden;" class="form-textarea ">{{$res.content}}</textarea></td>
        </tr>
      </table>
    </div>
    <div id="msg" class="msgbox"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
      	<td style="padding:5px 20px;"><input type="submit" name="btn_submit" class="btn btn-pri" value="修改" /></td>
			</tr>    
    </table>
  </div>
</div>
</form>

<script src="{{$APP_PATH}}/js/jquery-1.11.3.min.js"></script>
<script src="{{$APP_PATH}}/js/jquery.form.js"></script>
<script src="{{$APP_ADM}}/js/jquery.ready.js"></script>
<script src="{{$APP_PATH}}/js/layer/layer.js"></script>
<script src="{{$APP_PATH}}/js/layer/layui/layui.js"></script>
<script src="js/depart.edit.js"></script>
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
			'source', 'fontname', 'fontsize', '|', 'forcecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link'
		],
		afterBlur: function() { this.sync(); }
	});
});
//layui tab
layui.use('element', function(){
	var element = layui.element();
	element.on('tab(demo)', function(data){

  });
})
</script>
</body>
</html>