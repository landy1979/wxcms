<?php
/* Smarty version 3.1.29, created on 2017-07-20 16:52:05
  from "E:\web\lmfyjk\web\admin\tpl\depart\list.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_59706f35c807b9_40574261',
  'file_dependency' => 
  array (
    'eda3251b7a15a79e774db728b763d2ea8e505fb0' => 
    array (
      0 => 'E:\\web\\lmfyjk\\web\\admin\\tpl\\depart\\list.tpl',
      1 => 1500540717,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59706f35c807b9_40574261 ($_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '562559706f35bc9ab5_84641895';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>科室列表</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css" rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>
<body>

<div class="tab_navigator">
	<span>科室列表</span>
</div>

<div class="tools">
  <div>
		<input type="button" class="btn btn-pri btn-inline" value="添加科室" onclick="location.href='add.php';">
  </div>
</div>

<div class="container" style="margin:0; border:0">
	<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center" class="listTab">
  	<tr>
    	<td width="3%">ID</td>
      <td width="4%">选择</td>
      <td>科室名称</td>
			<td>电话</td>
      <td>地址</td>
      <td>状态</td>
      <td>操作</td>
    </tr>
    <?php
$_from = $_smarty_tpl->tpl_vars['list']->value;
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
    <tr>
    	<td><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" /></td>
      <td><input type="checkbox" name="id<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" /></td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depname'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['address'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['phone'];?>
</td>
      <td>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['isshow'] == 0) {?>
      	<span class="isshow layui-btn layui-btn-mini">正常</span>
        <?php } else { ?>
        <span class="isshow layui-btn layui-btn-mini layui-btn-danger">停用</span>
        <?php }?>
      </td>
      <td>
      	<span class="icon-span icon-man" onclick="doclist(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
)"><i></i>专家列表</span>
        <span class="icon-span icon-edit" onclick="edit(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
)"><i></i>修改</span>
        <span class="icon-span icon-delete" onclick="del(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
,'ajax/delete.php','确定要删除该科室吗？')"><i></i>删除</span>
      </td>
    </tr>
    <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
  </table>
  <div id="msg" class="msgbox"></div>
</div>

<!--paginator-->
<div id="operateBar" class="operateBar">
	<div class="operate">
	<input type="checkbox" onclick="selAll();" value="1" style="vertical-align:text-top;"/>全选&nbsp;
  <select name="type" id="selAct" class="form-input">
  	<option value="0">请选择...</option>
    <option value="del">删除</option>
  </select>
  <input type="button" class="btn btn-pri btn-inline" value="确定" />
  </div>
	<?php echo $_smarty_tpl->tpl_vars['pages']->value;?>

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
<?php echo '<script'; ?>
 src="js/depart.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
