<?php
/* Smarty version 3.1.29, created on 2017-08-02 15:46:34
  from "E:\web\lmfyjk\web\tpl\wap\list.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5981835ae06fc3_91460687',
  'file_dependency' => 
  array (
    'bb760756f1ae44abd9b4b1b04751d259d4c911d7' => 
    array (
      0 => 'E:\\web\\lmfyjk\\web\\tpl\\wap\\list.tpl',
      1 => 1501659989,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:wap/footer_inside.tpl' => 1,
  ),
),false)) {
function content_5981835ae06fc3_91460687 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'E:\\web\\lmfyjk\\web\\include\\smarty\\libs\\plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\web\\lmfyjk\\web\\include\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta name="keyword" content="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" />
<link href="css/common.css" rel="stylesheet">
<link href="css/list.css" rel="stylesheet">
<link href="js/swiper/css/swiper.min.css" rel="stylesheet">
</head>

<body onLoad="loaded()">
<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['catid']->value;?>
">

<header>
	<div class="titlebar">
    <i class="back"></i>
    <h2><?php echo $_smarty_tpl->tpl_vars['catname']->value;?>
</h2>
  </div>
</header>


<div class="swiper news-swiper" style="margin-top:45px;">
	<div class="swiper-wrapper">
  	<div class="swiper-slide">
    	<img src="<?php echo $_smarty_tpl->tpl_vars['cat']->value['logo'];?>
">
    	<span class="title"><?php echo $_smarty_tpl->tpl_vars['cat']->value['catname'];?>
</span>
    </div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<div class="wrap_list" id="wrapper" style="top:45px;">
<div id="scroller">
	<ul>
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
    <li><a href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
"></a>
      <div class="nr" <?php if (!$_smarty_tpl->tpl_vars['value']->value['titlepic']) {?> style="width:100%;" <?php }?>>
      	<h6><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value['title'],30);?>
</h6>
        <div class="desc">
        <?php if ($_smarty_tpl->tpl_vars['value']->value['titlepic']) {?>
        <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value['desc'],30);?>

        <?php } else { ?>
        <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value['desc'],100);?>

        <?php }?>
        </div>
        <div class="adate"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['value']->value['addtime'],'%Y-%m-%d');?>
</div>
      </div>
      <div class="cls"></div>
    </li>
    <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
  </ul>
</div>
</div>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:wap/footer_inside.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['AP_PATH']->value;?>
/js/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/list.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="js/swiper/js/swiper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
var swiper = new Swiper('.swiper',{
	loop: true,
	autoplay: 3000
});
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="js/iScroll/iscroll.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
var myScroll;

function loaded () {
	myScroll = new IScroll('#wrapper', { bounceEasing: 'elastic', bounceTime: 1200, click: true });
}
<?php echo '</script'; ?>
>

</body>
</html><?php }
}
