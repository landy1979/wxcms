<?php
/* Smarty version 3.1.29, created on 2017-07-21 18:31:48
  from "E:\web\lmfyjk\web\admin\tpl\doctor\list.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5971d8145e3c08_55008261',
  'file_dependency' => 
  array (
    '0f9cdd0f57f8e1636c6ef8c301b9981411b775e9' => 
    array (
      0 => 'E:\\web\\lmfyjk\\web\\admin\\tpl\\doctor\\list.tpl',
      1 => 1500632984,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5971d8145e3c08_55008261 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医生列表</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css" rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>
<body>

<div class="tab_navigator">
	<span><?php echo $_smarty_tpl->tpl_vars['depname']->value;?>
医生</span>
</div>

<div class="tools">
  <div>
		<input type="button" class="btn btn-pri btn-inline" value="添加医生" onclick="location.href='add.php?depid=<?php echo $_smarty_tpl->tpl_vars['depid']->value;?>
';">
  </div>
</div>

<div class="container" style="margin:0; border:0">
	<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center" class="listTab">
  	<tr>
    	<td width="3%">ID</td>
      <td width="4%">选择</td>
      <td>医生姓名</td>
			<td>科室</td>
      <td>职称</td>
      <td>预约费用</td>
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
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['docname'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['depname'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['titname'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['cost'];?>
</td>
      <td>
      <?php if ($_smarty_tpl->tpl_vars['value']->value['isallow'] == 1) {?>
      	<span class="isshow layui-btn layui-btn-mini">在职</span>
			<?php } else { ?>
      	<span class="isshow layui-btn layui-btn-mini layui-btn-danger">离职</span>
      <?php }?>
      </td>
      <td>
      	<span class="icon-span icon-reserver" onclick="reslist(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
)"><i></i>预约时间</span>
        <span class="icon-span icon-sch" onclick="schlist(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
)"><i></i>排班信息</span>
        <span class="icon-span icon-edit" onclick="edit(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
)"><i></i>修改</span>
        <span class="icon-span icon-delete" onclick="del(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
,'?act=del','确定要删除该医生信息吗？')"><i></i>删除</span>
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
 src="js/doctor.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
