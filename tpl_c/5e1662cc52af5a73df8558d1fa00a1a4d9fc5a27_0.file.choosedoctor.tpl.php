<?php
/* Smarty version 3.1.29, created on 2017-07-29 12:43:10
  from "D:\web\lmfyjk.cnywtc.net\tpl\wap\choosedoctor.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_597c125edeaf42_50740156',
  'file_dependency' => 
  array (
    '5e1662cc52af5a73df8558d1fa00a1a4d9fc5a27' => 
    array (
      0 => 'D:\\web\\lmfyjk.cnywtc.net\\tpl\\wap\\choosedoctor.tpl',
      1 => 1501292080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:wap/footer_inside.tpl' => 1,
  ),
),false)) {
function content_597c125edeaf42_50740156 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
_选择就诊医生</title>

<link href="css/common.css" rel="stylesheet">
<link href="css/list.css" rel="stylesheet">

<link href="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/agile/agile/css/agile.layout.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/agile/third/seedsui/plugin/seedsui/seedsui.min.css" rel="stylesheet">
</head>
<body>

<input type="text" name="depid" id="depid" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['id'];?>
" />

<div id="section_container">
	<section id="slider_section" data-role="section" class="active">
		<header>
			<div class="titlebar">
	      <i class="back"></i>
			  <i class="home"></i>
				<h2 class="text-center"><?php echo $_smarty_tpl->tpl_vars['res']->value['depname'];?>
</h2>
      </div>
			<div id="tabbarOuter" data-scroll="horizontal">
				<div class="scroller">
					<ul class="slidebar">
						<li class="tab active" data-role="tab" href="#page1" data-toggle="page">
							<label class="tab-label">专家预约</label>
						</li>
						<li class="tab" data-role="tab" href="#page2" data-toggle="page">
							<label class="tab-label">科室简介</label>
						</li>
					</ul>
				</div>
			</div>
		</header>
    
    <article data-role="article" id="slider_article" class="active" style="top:88px;bottom:54px;">
			<div id="sliderPage" data-role="slider" class="full">
				<div class="scroller">
					<div id="page1" class="slide" data-role="page" data-scroll="pulldown">
						<div class="scroller">
							<div id="slide" class="full week_container" data-role="slider">
                <div class="week-item">一</div>
                <div class="week-item">二</div>
                <div class="week-item">三</div>
                <div class="week-item">四</div>
                <div class="week-item">五</div>
                <div class="week-item">六</div>
                <div class="week-item">日</div>
              </div>
              <div class="day_container">
								<div class="day-item">10</div>
                <div class="day-item">11</div>
                <div class="day-item">12</div>
                <div class="day-item">13</div>
                <div class="day-item">14</div>
                <div class="day-item">15</div>
                <div class="day-item">16</div>
              </div>
              <p class="placedate"></p>
              <div id="result" class="sch querylist"></div>
						</div>
					</div>	
					<div id="page2" class="slide" data-role="page" data-scroll="verticle">
						<div class="scroller">
							<div class="desc">
                <div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['res']->value['pic'];?>
"></div>
                <div class="desc-head">
                  <span>科室电话：<a href="tel:<?php echo $_smarty_tpl->tpl_vars['res']->value['phone'];?>
"><?php echo $_smarty_tpl->tpl_vars['res']->value['phone'];?>
</a></span>
                  <span>地址：<?php echo $_smarty_tpl->tpl_vars['res']->value['address'];?>
</span>
                </div>
                <div class="content"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</div>
              </div>
						</div>
					</div>
				</div>
			</div>
		</article>
	</section>
</div>      
            

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:wap/footer_inside.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/agile/third/jquery/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/agile/third/iscroll/iscroll-probe.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/agile/agile/js/agile.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/agile/app/js/app.seedsui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_WAP']->value;?>
/js/date.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
(function(){
	$('#slider_section').on('sectionshow', function(){
		A.Component.scroll('#tabbarOuter');
	});
	$('#slider_article').on('articleload', function(){
		A.Slider('#slide', {
			dots : 'hide'
		});			
		A.Slider('#sliderPage', {
			dots : 'hide'
		});
	});	
})(jQuery)
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
