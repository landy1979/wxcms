<?php
/* Smarty version 3.1.29, created on 2017-07-29 12:42:46
  from "D:\web\lmfyjk.cnywtc.net\tpl\wap\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_597c12465411c2_83357366',
  'file_dependency' => 
  array (
    '8bf1f2d126efbf5a393e6ab03a496c6bf489ae21' => 
    array (
      0 => 'D:\\web\\lmfyjk.cnywtc.net\\tpl\\wap\\index.tpl',
      1 => 1500428860,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:wap/footer.tpl' => 1,
  ),
),false)) {
function content_597c12465411c2_83357366 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta charset="utf-8" />
<link href="css/common.css" rel="stylesheet">
<link href="js/swiper/css/swiper.min.css" rel="stylesheet">
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>

<body>


<div class="swiper">
	<div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/logo.png"></div>
	<div class="swiper-wrapper">
		<div class="swiper-slide"><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/w1.jpg"></div>
		<div class="swiper-slide"><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/w2.jpg"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>


<div class="panel">
	<div class="panel-box about">
  	<i><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/p1.png"></i>
    <span>医院概况</span>
  </div>
  <div class="panel-box news">
  	<i><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/p2.png"></i>
    <span>新闻中心</span>
  </div>
  <div class="panel-box guide">
  	<i><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/p3.png"></i>
    <span>就医指南</span>
  </div>
  <div class="panel-box party">
  	<i><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/p4.png"></i>
    <span>党建专栏</span>
  </div>
  <div class="panel-box news">
  	<i><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/p5.png"></i>
    <span>文化建设</span>
  </div>
  <div class="panel-box news">
  	<i><img src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/imgs/p6.png"></i>
    <span>便民服务</span>
  </div>
</div>


<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:wap/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php echo '<script'; ?>
 src="js/swiper/js/swiper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
var swiper = new Swiper('.swiper',{
	loop: true,
	autoplay: 3000,
	pagination: '.swiper-pagination'
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
