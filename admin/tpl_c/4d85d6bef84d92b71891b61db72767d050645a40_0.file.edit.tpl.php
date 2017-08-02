<?php
/* Smarty version 3.1.29, created on 2017-07-14 21:30:35
  from "D:\appSrv\lmfyjk\web\admin\tpl\depart\edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5968c77baa9d99_34379501',
  'file_dependency' => 
  array (
    '4d85d6bef84d92b71891b61db72767d050645a40' => 
    array (
      0 => 'D:\\appSrv\\lmfyjk\\web\\admin\\tpl\\depart\\edit.tpl',
      1 => 1500004573,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5968c77baa9d99_34379501 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加科室</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css"  rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
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
<input type="hidden" name="logo" id="logo" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['pic'];?>
" />
<input type="hidden" name="depid" id="depid" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['id'];?>
" />
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
	          <td colspan="2"><input type="text" name="depname" id="depname" size="30" class="form-input" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['depname'];?>
"><span class="required">*</span></td>
        	</tr>
          <tr>
          	<td class="label">联系电话：</td>
            <td colspan="2"><input type="text" name="phone" id="phone" size="30" class="form-input" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['phone'];?>
" /></td>
					</tr>
          <tr>
          	<td class="label">科室地址：</td>
            <td colspan="2"><input type="text" name="address" id="address" class="form-input" size="40" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['phone'];?>
" /></td>
					</tr>
          <tr>
          	<td class="label">科室图片：</td>
            <td width="30%"><iframe src="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/inc/up/upload.php?postfile=saveone.php" width="100%" height="24" frameborder="0" scrolling="no" id="upfile"></iframe></td>
            <td>
            <?php if ($_smarty_tpl->tpl_vars['res']->value['pic']) {?>
           	<div class="uppic" data-path="<?php echo $_smarty_tpl->tpl_vars['res']->value['pic'];?>
" style="width:80px;">
	         		<img src="<?php echo $_smarty_tpl->tpl_vars['res']->value['pic'];?>
" style="width: 100%; height: auto;" />
            </div>
            <?php }?>
            </td>
          </tr>
          <tr>
          	<td class="label">简短描述：</td>
            <td colspan="2"><textarea name="shortcontent" id="shortcontent"  rows="4" cols="70"><?php echo $_smarty_tpl->tpl_vars['res']->value['shortcontent'];?>
</textarea></td>
					</tr>
				</table>
      </div>
    </div>
    <div class="layui-tab-item">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
      	<tr>
        	<td><textarea name="content" id="content" style="width:80%;height:500px;visibility:hidden;" class="form-textarea "><?php echo $_smarty_tpl->tpl_vars['res']->value['content'];?>
</textarea></td>
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
/js/layer/layer.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/layui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/depart.edit.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
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
//layui tab
layui.use('element', function(){
	var element = layui.element();
	element.on('tab(demo)', function(data){

  });
})
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
