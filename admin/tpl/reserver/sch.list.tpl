<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>排班列表</title>
<link href="{{$APP_ADM}}/css/common.css" rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>
<body>

<div class="tab_navigator">
	<span>医生排班表</span>
</div>

<div class="tools">
  <div>
		<input type="button" class="btn btn-pri btn-inline" value="添加排班" onclick="location.href='sch.add.php?id={{$docid}}';">
  </div>
</div>

<div class="container" style="margin:0; border:0">
	<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center" class="listTab">
  	<tr>
    	<td>ID</td>
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
      <td>排班日期</td>
      <td>操作</td>
    </tr>
    {{foreach from=$list item=value}}
    <tr>
    	<td>{{$value.id}}</td>
    	<td>{{$value.doctor}}</td>
      <td>{{$value.w1}}</td>
      <td>{{$value.w2}}</td>
      <td>{{$value.w3}}</td>
      <td>{{$value.w4}}</td>
      <td>{{$value.w5}}</td>
      <td>{{$value.w6}}</td>
      <td>{{$value.w7}}</td>
      <td>{{$value.resnum1}}</td>
      <td>{{$value.resnum2}}</td>
      <td>{{if $value.start && $value.end}}{{$value.start|date_format:'Y-m-d'}} 至 {{$value.end|date_format:'Y-m-d'}}{{/if}}</td>
      <td>
        <span class="icon-span icon-edit" onclick="edit({{$value.docid}},{{$value.id}})"><i></i>修改</span>
        <span class="icon-span icon-delete" onclick="del({{$value.id}},'?act=del','确定要删除该医生的排班信息吗？')"><i></i>删除</span>
      </td>
    </tr>
    {{/foreach}}
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
	{{$pages}}
</div>

<script src="{{$APP_PATH}}/js/jquery-1.11.3.min.js"></script>
<script src="{{$APP_PATH}}/js/jquery.form.js"></script>
<script src="{{$APP_PATH}}/js/layer/layer.js"></script>
<script src="{{$APP_PATH}}/js/layer/layui/layui.js"></script>
<script src="{{$APP_ADM}}/js/jquery.ready.js"></script>
<script src="js/sch.js"></script>
</body>
</html>
