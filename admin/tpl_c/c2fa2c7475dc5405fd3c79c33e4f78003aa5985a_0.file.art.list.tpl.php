<?php
/* Smarty version 3.1.29, created on 2017-07-29 12:45:19
  from "D:\web\lmfyjk.cnywtc.net\admin\tpl\article\art.list.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_597c12df883e39_37702086',
  'file_dependency' => 
  array (
    'c2fa2c7475dc5405fd3c79c33e4f78003aa5985a' => 
    array (
      0 => 'D:\\web\\lmfyjk.cnywtc.net\\admin\\tpl\\article\\art.list.tpl',
      1 => 1499997241,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_597c12df883e39_37702086 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:\\web\\lmfyjk.cnywtc.net\\include\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章列表</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css" rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>
<body>

<div class="tab_navigator">
	<span>文章列表</span>
</div>

<div class="search tools">
	<form name="searchForm" id="searchForm" method="post" onsubmit="return false;">
  <div>
  	<span>搜索类型：</span>
    <select name="ty" id="ty" class="form-input" style="padding:0 5px;">
	    <option value="0">标题</option>
      <option value="1">来源</option>
    </select>
    <input type="text" name="keyword" id="keyword" size="40" class="form-input" />
    <input type="submit" value="搜索" id="btn_search" class="btn btn-pri btn-inline" />
		<input type="button" class="btn btn-pri btn-inline" value="添加文章" onclick="location.href='art.add.php';">
  </div>
  </form>
</div>

<div class="container" style="margin:0; border:0">
	<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center" class="listTab">
  	<tr>
    	<td width="3%">ID</td>
      <td width="4%">选择</td>
      <td>文章标题</td>
			<td>栏目</td>
      <td>发表时间</td>
			<td>发布人</td>
      <td>审核</td>
      <td>排序</td>
      <td>点击</td>
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
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['catname'];?>
</td>
      <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['value']->value['addtime'],'%Y-%m-%d %H:%M:%S');?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['writer'];?>
</td>
      <td>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['isallow'] == 0) {?>
      	<span class="isallow layui-btn layui-btn-mini layui-btn-danger">未通过</span>
        <?php } else { ?>
        <span class="isallow layui-btn layui-btn-mini">通过</span>
        <?php }?>
      </td>
      <td><input type="text" name="order" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['orders'];?>
" class="form-input" size="10" /></td>
      <td><?php echo $_smarty_tpl->tpl_vars['value']->value['click'];?>
</td>
      <td>
      	<span class="icon-span icon-edit" onclick="editArc(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
)"><i></i>修改</span>
        <span class="icon-span icon-delete delete"><i></i>删除</span>
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
    <option value="allow">审核</option>
    <option value="mark">推荐</option>
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
 src="js/art.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
