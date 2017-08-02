<?php
/* Smarty version 3.1.29, created on 2017-07-30 00:09:03
  from "D:\appSrv\lmfyjk\web\admin\tpl\article\art.edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_597cb31f8e9a09_36203302',
  'file_dependency' => 
  array (
    '84a96f13088edbf11e92fac381031040ce06b686' => 
    array (
      0 => 'D:\\appSrv\\lmfyjk\\web\\admin\\tpl\\article\\art.edit.tpl',
      1 => 1501323578,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_597cb31f8e9a09_36203302 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:\\appSrv\\lmfyjk\\web\\include\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改文章</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css" rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
<link href="css/art.css" rel="stylesheet" />
<!-- kindeditor -->
<?php echo '<script'; ?>
 charset="utf-8" src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/include/kindeditor/kindeditor-min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 charset="utf-8" src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/include/kindeditor/lang/zh_CN.js"><?php echo '</script'; ?>
>
<!-- kindeditor -->
</head>
<body>

<form name="form" id="form" method="post">
<input type="hidden" name="art_id" id="art_id" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['id'];?>
" />
<input type="hidden" name="catid" id="catid" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['catid'];?>
" />
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
            <input type="text" name="title" id="title" class="form-input" size="60" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['title'];?>
" /><span class="required">*</span>
            简短标题：<input type="text" name="shorttitle" id="shorttitle" class="form-input" size="35" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['shorttitle'];?>
" />
            </td>
        	</tr>
					<tr>
          	<td class="label">文章栏目：</td>
						<td colspan="3">
            <select name="pcat" id="pcat" class="form-input">
            	<option value="0">请选择文章栏目</option>
              <?php echo $_smarty_tpl->tpl_vars['cats']->value;?>

            </select>
            </td>
          </tr>
          <tr>
          	<td class="label">关键字：</td>
            <td><input type="text" name="keyword" id="keyword" class="form-input" size="50" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['keyword'];?>
" />&nbsp;<span class="fc">多个关键字请用","号隔开</span></td>
          </tr>
          <tr>
          	<td class="label">跳转网址：</td>
            <td colspan="3"><input type="text" name="linkurl" id="linkurl" size="50" class="form-input" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['linkurl'];?>
" />&nbsp;<span class="fc">文章跳转链接地址</span></td>
          </tr>
          <tr>
          	<td class="label">文章来源：</td>
	          <td>
            <input type="text" name="source" id="source" class="form-input" size="20" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['source'];?>
" />
            文章作者：
            <input type="text" name="writer" id="writer" class="form-input" size="20" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['writer'];?>
" />
            </td>
          </tr>
          <tr>
          	<td class="label">发表时间：</td>
            <td><input type="text" name="addtime" id="addtime" class="form-input" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',skin:'whyGreen'});" size="20" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['res']->value['addtime'],'%Y-%m-%d %H:%M:%S');?>
" /></td>
          </tr>
          <tr>
          	<td class="label">文章简介：</td>
            <td colspan="3"><textarea name="shortbody" id="shortbody" cols="70" rows="8" class="form-textarea"><?php echo $_smarty_tpl->tpl_vars['res']->value['shortbody'];?>
</textarea></td>
					</tr>
        </table>
      </div>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
        <tr>
          <td><iframe src="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/inc/up/upload.php?postfile=savethumbmulti.php" id="upfile" width="100%" height="24" frameborder="0" scrolling="no"></iframe></td>
        </tr>
        <tr>
						<td id="multi_up">
            <?php if ($_smarty_tpl->tpl_vars['pics']->value) {?>
            <?php
$_from = $_smarty_tpl->tpl_vars['pics']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_0_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_0_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
            	<div class="uppic" data-path="<?php echo $_smarty_tpl->tpl_vars['value']->value['path'];?>
" data-pics="<?php echo $_smarty_tpl->tpl_vars['value']->value['picname'];?>
" data-order="<?php echo $_smarty_tpl->tpl_vars['value']->value['orders'];?>
" data-index="<?php echo $_smarty_tpl->tpl_vars['value']->value['orders']-1;?>
">
	              <img src="<?php echo $_smarty_tpl->tpl_vars['value']->value['picpath'];?>
" style="width: 100%; height: auto;" />
  	            <div class="picorder" title="排序"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['orders'];?>
" onchange="picorder(this)"></div>
                <div class="operate">
                	<i class="toleft" onclick="leftuppic(this)">左移</i>
                  <i class="toright" onclick="rightuppic(this)">右移</i>
                  <i class="delPic" onclick="deleteuppic(this)">删除</i>
                </div>
              </div>
            <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
            <?php }?>
            </td>
				</tr>
      </table>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
        <tr>
          <td><textarea name="content" id="content" style="width:80%;height:450px;visibility:hidden;" class="form-textarea "><?php echo $_smarty_tpl->tpl_vars['res']->value['body'];?>
</textarea></td>
        </tr>
      </table>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
        <tr>
          <td><textarea name="wapcontent" id="wapcontent" style="width:80%;height:450px;visibility:hidden;" class="form-textarea "><?php echo $_smarty_tpl->tpl_vars['res']->value['wapbody'];?>
</textarea></td>
        </tr>
      </table>
    </div>
    <div id="msg" class="msgbox"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
      <tr>
        <td height="35" style="padding:5px 20px;"><input type="button" name="btn_submit" class="btn btn-pri" id="btn_edsave" value="提交" /></td>
      </tr>
    </table>
  </div>
</div>
</form>
 
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/jquery.form.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/js/jquery.ready.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/m97/WdatePicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layer.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/layui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/art.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/art.edit.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
(function(){
	$("#pcat").val($("#catid").val());
})(jQuery)
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
	
	wapeditor = K.create("textarea[name=wapcontent]", {
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

layui.use('element', function(){
	var element = layui.element();
	element.on('tab(demo)', function(data){

  });
})
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
