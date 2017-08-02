<?php
/* Smarty version 3.1.29, created on 2017-08-02 10:31:43
  from "D:\appSrv\lmfyjk\web\tpl\wap\article.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5981398f5d3491_80937321',
  'file_dependency' => 
  array (
    '24f5d47927ae61ad1787f21e7629ac3c28d15e99' => 
    array (
      0 => 'D:\\appSrv\\lmfyjk\\web\\tpl\\wap\\article.tpl',
      1 => 1501640108,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5981398f5d3491_80937321 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:\\appSrv\\lmfyjk\\web\\include\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta name="keyword" content="<?php echo $_smarty_tpl->tpl_vars['res']->value['keyword'];?>
" />
<link href="css/common.css" rel="stylesheet">
<link href="css/arc.css" rel="stylesheet">

</head>

<body>

<input type="text" name="arcId" id="arcId" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['id'];?>
">
<input type="text" name="catId" id="catId" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['catid'];?>
">

<header>
	<div class="titlebar">
    <i class="back"></i>
    <h2><?php echo $_smarty_tpl->tpl_vars['res']->value['catname'];?>
</h2>
  </div>
</header>

<div id="wrapper">
	<div class="title">
  	<h2><?php echo $_smarty_tpl->tpl_vars['res']->value['title'];?>
</h2>
  </div>
  <?php if ($_smarty_tpl->tpl_vars['res']->value['id'] != 29) {?>
  <div class="attr">
  	<span>文章来源：<?php echo $_smarty_tpl->tpl_vars['res']->value['source'];?>
</span><span>作者：<?php echo $_smarty_tpl->tpl_vars['res']->value['writer'];?>
</span><span>日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['res']->value['addtime'],'%Y-%d-%m');?>
</span>
  </div>
  <?php }?>
  <div class="content"><?php echo $_smarty_tpl->tpl_vars['res']->value['body'];?>
</div>
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['AP_PATH']->value;?>
/js/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/arc.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
