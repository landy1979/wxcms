<?php
/* Smarty version 3.1.29, created on 2017-07-18 15:39:34
  from "E:\web\lmfyjk\web\admin\tpl\reserver\sch.list.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_596dbb364a40c2_82556236',
  'file_dependency' => 
  array (
    'd71bfc956473ee53f93df9ecc28003c74c8adee6' => 
    array (
      0 => 'E:\\web\\lmfyjk\\web\\admin\\tpl\\reserver\\sch.list.tpl',
      1 => 1500351887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_596dbb364a40c2_82556236 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>排班列表</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css" rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>
<body>

<div class="tab_navigator">
	<span>医生排班表</span>
</div>

<div class="tools">
  <div>
		<input type="button" class="btn btn-pri btn-inline" value="添加排班" onclick="location.href='add.php';">
  </div>
</div>

<div class="container" style="margin:0; border:0">
	<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center" class="listTab">
  	<tr>
    	<td>就诊专家</td>
      <td>星期一</td>
      <td>星期二</td>
      <td>星期三</td>
      <td>星期四</td>
      <td>星期五</td>
      <td>星期六</td>
      <td>星期天</td>
      <td>上午预约量</td>
      <td>下等预约量</td>
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
    	<td><?php echo $_smarty_tpl->tpl_vars['value']->value['doctor'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['w1'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['w2'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['w3'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['w4'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['w5'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['w6'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['w7'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['resnum1'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['resnum2'];?>
</td>
      <td>
        <span class="icon-span icon-edit" onclick="edit(<?php echo $_smarty_tpl->tpl_vars['value']->value['docid'];?>
)"><i></i>修改</span>
        <span class="icon-span icon-delete" onclick="del(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
,'?act=del','确定要删除该医生的排班信息吗？')"><i></i>删除</span>
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
 src="js/res.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
