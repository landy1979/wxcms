<?php
/* Smarty version 3.1.29, created on 2017-07-29 12:45:30
  from "D:\web\lmfyjk.cnywtc.net\admin\tpl\reserver\sch.add.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_597c12ead76752_25156116',
  'file_dependency' => 
  array (
    'dbb0ac356e3e28f6a944423e186b38847bd8b196' => 
    array (
      0 => 'D:\\web\\lmfyjk.cnywtc.net\\admin\\tpl\\reserver\\sch.add.tpl',
      1 => 1501055228,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_597c12ead76752_25156116 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置预约时间</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/css/common.css"  rel="stylesheet" />
<link href="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>

<body>

<form name="form" id="form" method="post">
<input type="hidden" name="docid" id="docid" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['id'];?>
" />
<input type="hidden" name="depid" id="depid" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['depid'];?>
" />
<input type="hidden" name="docname" id="docname" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['docname'];?>
" />
<div class="tab_navigator">
	<span>医生预约信息</span>
</div>

<div class="container">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
		<tr>
  	 	<td class="label" width="8%">医生姓名：</td>
	    <td><span style="line-height:22px; display:block;"><?php echo $_smarty_tpl->tpl_vars['res']->value['docname'];?>
</span></td>
    </tr>
    <?php echo outputWeek(array('count'=>7),$_smarty_tpl);?>

    <tr>
    	<td>上午预约量：</td>
      <td><input type="text" name="resnum1" id="resnum1" class="form-input" /><span class="required">*</span></td>
    </tr>
    <tr>
    	<td>下午预约量：</td>
      <td><input type="text" name="resnum2" id="resnum2" class="form-input" /><span class="required">*</span></td>
    </tr>
    <tr>
    	<td>排班时间：</td>
      <td>
        <input type="text" name="startDate" class="Wdate form-input" id="d4321" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',skin:'whyGreen',maxDate:'#F{$dp.$D(\'d4322\',{d:-6});}'})"> 至
        <input type="text" name="endDate" class="Wdate form-input" id="d4322" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',skin:'whyGreen',minDate:'#F{$dp.$D(\'d4321\',{d:6});}'})">
      </td>
		</tr>
    <tr>
     	<td style="padding:5px 20px;"><input type="submit" name="btn_submit" class="btn btn-pri" value="提交" /></td>
		</tr>
	</table>
	<div id="msg" class="msgbox"></div>
</div>

</form>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/jquery.form.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['APP_ADM']->value;?>
/js/jquery.ready.js"><?php echo '</script'; ?>
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
 src="<?php echo $_smarty_tpl->tpl_vars['APP_PATH']->value;?>
/js/m97/WdatePicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/sch.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
