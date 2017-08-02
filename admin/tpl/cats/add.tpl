<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加文章栏目</title>
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
<div class="layui-tab layui-tab-card" lay-filter="demo">
	<ul class="layui-tab-title">
  	<li class="layui-this">栏目信息</li>
    <li>栏目内容</li>
  </ul>
  <div class="layui-tab-content container">
    <div class="layui-tab-item layui-show">
    	<div class="item-content">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
       		<tr>
          	<td class="label" width="8%">栏目名称：</td>
	          <td><input type="text" name="catname" id="catname" size="30" class="form-input"><span class="required">*</span></td>
        	</tr>
          <tr>
          	<td class="label" width="8%">上级栏目：</td>
	          <td><select name="parent" id="parent" class="form-input"><option value="0">顶级栏目</option>{{$cats}}</select></td>
        	</tr>
          <tr>
          	<td class="label">栏目保存目录：</td>
            <td><input type="text" name="folder" id="folder" size="30" class="form-input" />&nbsp;&nbsp;<span><input type="checkbox" name="py" id="py" value="1" />拼音</span></td>
					</tr>
          <tr>
          	<td class="label">是否单页：</td>
            <td><input type="radio" name="onepage" value="0" checked="checked" class="form-input" style="vertical-align:middle;" />&nbsp;否&nbsp;<input type="radio" name="onepage" value="1" class="form-input" style="vertical-align:middle;" />&nbsp;是</td>
					</tr>
          <tr>
          	<td class="label">排序顺序：</td>
            <td><input type="text" name="orders" id="orders" class="form-input" value="50" size="30" /></td>
          </tr>
          <tr>
          	<td class="label">栏目图片：</td>
            <td><iframe src="{{$APP_ADM}}/inc/up/upload.php?postfile=saveone.php" width="100%" height="24" frameborder="0" scrolling="no"></iframe></td>
          </tr>
          <tr>
          	<td class="label">列表页模板：</td>
            <td><input type="text" name="tpllist" id="tpllist" value="list.tpl" size="30" class="form-input" /></td>
					</tr>
          <tr>
          	<td class="label">文章页模板：</td>
            <td><input type="text" name="arclist" id="arclist" value="arc.tpl" size="30" class="form-input" /></td>
					</tr>
          <tr>
          	<td class="label">SEO标题：</td>
            <td><input type="text" name="seotitle" id="seotitle" size="30" class="form-input" /></td>
					</tr>
          <tr>
          	<td class="label">关键字：</td>
            <td><input type="text" name="keyword" id="keyword" size="30" class="form-input" />&nbsp;<span class="fc">多个关键字用","号隔开</span></td>
					</tr>
          <tr>
          	<td class="label">栏目描述：</td>
            <td><textarea name="description" id="description"  rows="4" cols="70"></textarea></td>
					</tr>
				</table>
      </div>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
      	<tr>
        	<td><textarea name="content" id="content" style="width:80%;height:500px;visibility:hidden;" class="form-textarea "></textarea></td>
        </tr>
      </table>
    </div>
    <div id="msg" class="msgbox"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
      	<td style="padding:5px 20px;"><input type="submit" name="btn_submit" class="btn btn-pri" value="提交" /></td>
			</tr>    
    </table>
  </div>
</div>
</form>

<script src="{{$APP_PATH}}/js/jquery-1.11.3.min.js"></script>
<script src="{{$APP_PATH}}/js/jquery.form.js"></script>
<script src="{{$APP_ADM}}/js/jquery.ready.js"></script>
<script src="{{$APP_ADM}}/js/pinyin.js"></script>
<script src="{{$APP_PATH}}/js/layer/layer.js"></script>
<script src="{{$APP_PATH}}/js/layer/layui/layui.js"></script>
<script src="js/cat.js"></script>
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
