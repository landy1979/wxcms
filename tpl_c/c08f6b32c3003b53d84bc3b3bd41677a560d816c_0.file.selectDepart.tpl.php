<?php
/* Smarty version 3.1.29, created on 2017-07-29 17:53:56
  from "E:\web\lmfyjk\web\tpl\wap\selectDepart.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_597c5b34bb8643_15718409',
  'file_dependency' => 
  array (
    'c08f6b32c3003b53d84bc3b3bd41677a560d816c' => 
    array (
      0 => 'E:\\web\\lmfyjk\\web\\tpl\\wap\\selectDepart.tpl',
      1 => 1501322034,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:wap/footer_inside.tpl' => 1,
  ),
),false)) {
function content_597c5b34bb8643_15718409 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta charset="utf-8" />
<link href="css/common.css" rel="stylesheet">
<link href="css/list.css" rel="stylesheet">
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>

<body onLoad="loaded()">



<header>
	<div class="titlebar">
    <i class="back"></i>
    <i class="home"></i>
    <h2>就诊科室</h2>
  </div>
</header>

<div id="wrapper">
	<div id="scroller" class="deplist">
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
    	<li data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
      	<a href="choosedoctor.php?depid=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
"></a>
        <div class="dep_txt">
	      	<span class="title"><?php echo $_smarty_tpl->tpl_vars['value']->value['depname'];?>
</span>
          <span class="phone">科室电话：<?php echo $_smarty_tpl->tpl_vars['value']->value['phone'];?>
</span>
          <span class="nums">可预约医生数：<?php echo $_smarty_tpl->tpl_vars['value']->value['nums'];?>
</span>
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
 src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/agile/third/jquery/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/common.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="js/iScroll/iscroll.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
//swiper
var myScroll;

function loaded () {
	myScroll = new IScroll('#wrapper', {
		mouseWheel: true,
		scrollbars:	false,
	});
}
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
