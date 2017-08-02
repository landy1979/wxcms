<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置预约时间</title>
<link href="{{$APP_ADM}}/css/common.css"  rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>

<body>

<form name="form" id="form" method="post">
<input type="id" name="id" value="{{$res.sId}}" />
<input type="hidden" name="docid" id="docid" value="{{$res.id}}" />
<input type="hidden" name="depid" id="depid" value="{{$res.depid}}" />
<input type="hidden" name="docname" id="docname" value="{{$res.docname}}" />
<input type="hidden" id="reserver" value="{{$reserver}}" />
<div class="tab_navigator">
	<span>医生预约信息</span>
</div>

<div class="container">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" class="commTab">
		<tr>
  	 	<td class="label" width="8%">医生姓名：</td>
	    <td><span style="line-height:22px; display:block;">{{$res.docname}}</span></td>
    </tr>
    {{resOfWeek count=7}}
    <tr>
    	<td>上午预约量：</td>
      <td><input type="text" name="resnum1" id="resnum1" class="form-input" value="{{$res.resnum1}}" /><span class="required">*</span></td>
    </tr>
    <tr>
    	<td>下午预约量：</td>
      <td><input type="text" name="resnum2" id="resnum2" class="form-input" value="{{$res.resnum2}}" /><span class="required">*</span></td>
    </tr>
    <tr>
    	<td>排班时间：</td>
      <td>
        <input type="text" name="startDate" class="Wdate form-input" id="d4321" value="{{if $res.startDate}}{{$res.startDate|date_format:'Y-m-d'}}{{/if}}" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',skin:'whyGreen',maxDate:'#F{$dp.$D(\'d4322\',{d:-3});}'})"> 至
        <input type="text" name="endDate" class="Wdate form-input" id="d4322" value="{{if $res.endDate}}{{$res.endDate|date_format:'Y-m-d'}}{{/if}}" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',skin:'whyGreen',minDate:'#F{$dp.$D(\'d4321\',{d:3});}'})">
      </td>
		</tr>
    <tr>
     	<td style="padding:5px 20px;"><input type="submit" name="btn_submit" class="btn btn-pri" value="提交" /></td>
		</tr>
	</table>
	<div id="msg" class="msgbox"></div>
</div>

</form>

<script src="{{$APP_PATH}}/js/jquery-1.11.3.min.js"></script>
<script src="{{$APP_PATH}}/js/jquery.form.js"></script>
<script src="{{$APP_ADM}}/js/jquery.ready.js"></script>
<script src="{{$APP_PATH}}/js/layer/layer.js"></script>
<script src="{{$APP_PATH}}/js/layer/layui/layui.js"></script>
<script src="{{$APP_PATH}}/js/m97/WdatePicker.js"></script>
<script src="js/sch.edit.js"></script>

</body>
</html>