<?php
/* Smarty version 3.1.29, created on 2017-07-21 16:22:29
  from "E:\web\lmfyjk\web\admin\tpl\doctor\edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5971b9c561be45_10851852',
  'file_dependency' => 
  array (
    'e764c538cd3b8b3eaa768ce80bfd842b56b8677d' => 
    array (
      0 => 'E:\\web\\lmfyjk\\web\\admin\\tpl\\doctor\\edit.tpl',
      1 => 1500625346,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5971b9c561be45_10851852 ($_smarty_tpl) {
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
<input type="hidden" name="oldlogo" id="oldlogo" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['pic'];?>
" />
<input type="hidden" name="logo" id="logo" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['pic'];?>
" />
<select id="pcat" style="display:none;"><option value="0">0</option></select>
<input type="hidden" name="depid" id="depid" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['depid'];?>
" />
<input type="hidden" name="titles" id="titles" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['title'];?>
" />
<input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['id'];?>
" />
<div class="tab_navigator">
	<span>医生信息</span>
</div>

<div class="container">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
		<tr>
  	 	<td class="label" width="8%">医生姓名：</td>
	    <td colspan="2"><input type="text" name="docname" id="docname" size="30" class="form-input" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['docname'];?>
"><span class="required">*</span></td>
    </tr>
    <tr>
     	<td class="label">联系电话：</td>
      <td colspan="2"><input type="text" name="phone" id="phone" size="30" class="form-input" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['phone'];?>
" /></td>
		</tr>
    <tr>
    	<td class="label">所属职务：</td>
      <td colspan="2">
      	<select name="title" id="title" class="form-input">
      		<?php
$_from = $_smarty_tpl->tpl_vars['title']->value;
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
					<option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['titname'];?>
</option>
       		<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
        </select><span class="required">*</span>
      </td>
		</tr>
    <tr>
     	<td class="label">医生头像：</td>
      <td width="30%"><iframe src="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/inc/up/upload.php?postfile=saveone.php" width="100%" height="24" frameborder="0" scrolling="no" id="upfile"></iframe></td>
      <td>
        <div class="uppic" data-path="<?php echo $_smarty_tpl->tpl_vars['res']->value['pic'];?>
" style="width:80px;">
          <img src="<?php echo $_smarty_tpl->tpl_vars['res']->value['pic'];?>
" style="width: 100%; height: auto;">
        </div>
      </td>      
    </tr>
    <tr>
    	<td class="label" valign="top">医生简介：</td>
    	<td colspan="2"><textarea name="content" id="content" style="width:80%;height:300px;visibility:hidden;" class="form-textarea "><?php echo $_smarty_tpl->tpl_vars['res']->value['content'];?>
</textarea></td>
    </tr>
    <tr>
     	<td style="padding:5px 20px;"><input type="submit" name="btn_submit" class="btn btn-pri" value="提交" /></td>
		</tr>
	</table>
	<div id="msg" class="msgbox"></div>
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
 src="js/doctor.edit.js"><?php echo '</script'; ?>
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
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
