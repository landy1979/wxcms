<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加文章</title>
<link href="{{$APP_ADM}}/css/common.css" rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
<link href="css/art.css" rel="stylesheet" />
<!-- kindeditor -->
<script charset="utf-8" src="{{$APP_PATH}}/include/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="{{$APP_PATH}}/include/kindeditor/lang/zh_CN.js"></script>
<!-- kindeditor -->
</head>
<body>

<form name="form" id="form" method="post">
<div class="layui-tab layui-tab-card" lay-filter="demo">
	<ul class="layui-tab-title">
  	<li class="layui-this">基本信息</li>
    <li>图片上传</li>
    <li>文章内容</li>
    <li>手机版内容</li>
  </ul>
  <div class="layui-tab-content container" style="height:500px;">
    <div class="layui-tab-item layui-show">
    	<div class="item-content">
	      <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
        	<tr>
          	<td class="label" width="8%">文章标题：</td>
	          <td>
            <input type="text" name="title" id="title" class="form-input" size="60" /><span class="required">*</span>
            简短标题：<input type="text" name="shorttitle" id="shorttitle" class="form-input" size="35" />
            </td>
        	</tr>
					<tr>
          	<td class="label">文章栏目：</td>
						<td colspan="3">
            <select name="pcat" id="pcat" class="form-input">
            	<option value="0">请选择文章栏目</option>
              {{$cats}}
            </select>
            </td>
          </tr>
          <tr>
          	<td class="label">关键字：</td>
            <td><input type="text" name="keyword" id="keyword" class="form-input" size="50" />&nbsp;<span class="fc">多个关键字请用","号隔开</span></td>
          </tr>
          <tr>
          	<td class="label">跳转网址：</td>
            <td colspan="3"><input type="text" name="linkurl" id="linkurl" size="50" class="form-input" />&nbsp;<span class="fc">文章跳转链接地址</span></td>
          </tr>
          <tr>
          	<td class="label">文章来源：</td>
	          <td>
            <input type="text" name="source" id="source" class="form-input" size="20" />
            文章作者：
            <input type="text" name="writer" id="writer" class="form-input" size="20" />
            </td>
          </tr>
          <tr>
          	<td class="label">发表时间：</td>
            <td><input type="text" name="addtime" id="addtime" class="form-input" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',skin:'whyGreen'});" size="20" /></td>
          </tr>
          <tr>
          	<td class="label">文章简介：</td>
            <td colspan="3"><textarea name="shortbody" id="shortbody" cols="70" rows="8" class="form-textarea"></textarea></td>
					</tr>
        </table>
      </div>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
        <tr>
          <td><iframe src="{{$APP_ADM}}/inc/up/upload.php?postfile=savethumbmulti.php" id="upfile" width="100%" height="24" frameborder="0" scrolling="no"></iframe></td>
        </tr>
        <tr>
						<td id="multi_up"></td>
				</tr>
      </table>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
        <tr>
          <td><textarea name="content" id="content" style="width:80%;height:450px;visibility:hidden;" class="form-textarea "></textarea></td>
        </tr>
      </table>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
        <tr>
          <td><textarea name="wapcontent" id="wapcontent" style="width:80%;height:450px;visibility:hidden;" class="form-textarea "></textarea></td>
        </tr>
      </table>
    </div>
    <div id="msg" class="msgbox"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
      <tr>
        <td height="35" style="padding:5px 20px;"><input type="button" name="btn_submit" class="btn btn-pri" id="btn_save" value="提交" /></td>
      </tr>
    </table>    
  </div>
</div>
</form>
 
<script src="{{$APP_PATH}}/js/jquery-1.11.3.min.js"></script>
<script src="{{$APP_PATH}}/js/jquery.form.js"></script>
<script src="{{$APP_ADM}}/js/jquery.ready.js"></script>
<script src="{{$APP_PATH}}/js/m97/WdatePicker.js"></script>
<script src="{{$APP_PATH}}/js/layer/layer.js"></script>
<script src="{{$APP_PATH}}/js/layer/layui/layui.js"></script>
<script src="js/art.js"></script>
<script src="js/art.add.js"></script>
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
			'source', 'fontname', 'fontsize', 'forecolor', '|', 'forcecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'insertfile'
		],
		afterBlur: function() { this.sync(); }
	});
	
	wapeditor = K.create("textarea[name=wapcontent]", {
		resizeType: 1,
		allowImageUpload: true,
		allowFileManager : true,
		items: [
			'source', 'fontname', 'fontsize', 'forecolor', '|', 'forcecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'insertfile'
		],
		afterBlur: function() { this.sync(); }
	});
	
});

layui.use('element', function(){
	var element = layui.element();
	element.on('tab(demo)', function(data){

  });
})
</script>
</body>
</html>
