<?php
/* Smarty version 3.1.29, created on 2017-07-15 10:51:01
  from "D:\appSrv\lmfyjk\web\admin\tpl\titles\edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_596983159c9069_06305708',
  'file_dependency' => 
  array (
    '395882d470589eef3119ea68c31cffc057c841de' => 
    array (
      0 => 'D:\\appSrv\\lmfyjk\\web\\admin\\tpl\\titles\\edit.tpl',
      1 => 1500087014,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_596983159c9069_06305708 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>职称修改</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css"  rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>

<body>

<div class="tab_navigator">
	<span>职称信息</span>
</div>

<form name="form" id="form" method="post">
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['id'];?>
" />
<div class="container">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
		<tr>
    	<td class="label" width="8%">医生职称：</td>
	    <td><input type="text" name="titlename" id="titlename" size="30" class="form-input" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['titname'];?>
"><span class="required">*</span></td>
    </tr>
    <tr>
    	<td class="label">预约费用：</td>
      <td><input type="text" name="cost" id="cost" size="30" class="form-input" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['cost'];?>
" /> 元 (四舍五入后保留2位小数)<span class="required">*</span></td>
		</tr>
    <tr>
    	<td style="padding:5px 20px;"><input type="submit" name="btn_submit" class="btn btn-pri" value="修改" /></td>
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
 src="js/edit.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
