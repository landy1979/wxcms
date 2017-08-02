<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医生列表</title>
<link href="{{$APP_ADM}}/css/common.css" rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
</head>
<body>

<div class="tab_navigator">
	<span>{{$depname}}医生</span>
</div>

<div class="tools">
  <div>
		<input type="button" class="btn btn-pri btn-inline" value="添加医生" onclick="location.href='add.php?depid={{$depid}}';">
  </div>
</div>

<div class="container" style="margin:0; border:0">
	<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center" class="listTab">
  	<tr>
    	<td width="3%">ID</td>
      <td width="4%">选择</td>
      <td>医生姓名</td>
			<td>科室</td>
      <td>职称</td>
      <td>预约费用</td>
      <td>状态</td>
      <td>操作</td>
    </tr>
    {{foreach from=$list item=value}}
    <tr>
    	<td>{{$value.id}}<input type="hidden" name="id" value="{{$value.id}}" /></td>
      <td><input type="checkbox" name="id{{$value.id}}" /></td>
      <td>{{$value.docname}}</td>
      <td>{{$value.depname}}</td>
      <td>{{$value.titname}}</td>
      <td>{{$value.cost}}</td>
      <td>
      {{if $value.isallow eq 1}}
      	<span class="isshow layui-btn layui-btn-mini">在职</span>
			{{else}}
      	<span class="isshow layui-btn layui-btn-mini layui-btn-danger">离职</span>
      {{/if}}
      </td>
      <td>
      	<span class="icon-span icon-reserver" onclick="reslist({{$value.id}})"><i></i>预约时间</span>
        <span class="icon-span icon-sch" onclick="schlist({{$value.id}})"><i></i>排班信息</span>
        <span class="icon-span icon-edit" onclick="edit({{$value.id}})"><i></i>修改</span>
        <span class="icon-span icon-delete" onclick="del({{$value.id}},'?act=del','确定要删除该医生信息吗？')"><i></i>删除</span>
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
<script src="js/doctor.js"></script>

</body>
</html>
