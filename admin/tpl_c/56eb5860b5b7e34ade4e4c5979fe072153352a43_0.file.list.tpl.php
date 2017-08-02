<?php
/* Smarty version 3.1.29, created on 2017-08-02 19:14:33
  from "E:\web\lmfyjk\web\admin\tpl\cats\list.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5981b419475c36_04710210',
  'file_dependency' => 
  array (
    '56eb5860b5b7e34ade4e4c5979fe072153352a43' => 
    array (
      0 => 'E:\\web\\lmfyjk\\web\\admin\\tpl\\cats\\list.tpl',
      1 => 1501672470,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5981b419475c36_04710210 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目列表</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css" rel="stylesheet" />
<link href="css/cats.css" rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
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
			<?php echo $_smarty_tpl->tpl_vars['list']->value;?>

  		</form>
			</td>
		</tr>
	</table>                
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/jquery.form.js"><?php echo '</script'; ?>
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
 src="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/js/jquery.ready.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
