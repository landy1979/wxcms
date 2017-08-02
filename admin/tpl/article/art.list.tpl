<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章列表</title>
<link href="{{$APP_ADM}}/css/common.css" rel="stylesheet" />
<link href="{{$APP_PATH}}/js/layer/layui/css/layui.css" rel="stylesheet" />
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
    {{foreach from=$list item=value}}
    <tr>
    	<td>{{$value.id}}<input type="hidden" name="id" value="{{$value.id}}" /></td>
      <td><input type="checkbox" name="id{{$value.id}}" /></td>
      <td>{{$value.title}}</td>
      <td>{{$value.catname}}</td>
      <td>{{$value.addtime|date_format:'%Y-%m-%d %H:%M:%S'}}</td>
      <td>{{$value.writer}}</td>
      <td>
        {{if $value.isallow eq 0}}
      	<span class="isallow layui-btn layui-btn-mini layui-btn-danger">未通过</span>
        {{else}}
        <span class="isallow layui-btn layui-btn-mini">通过</span>
        {{/if}}
      </td>
      <td><input type="text" name="order" value="{{$value.orders}}" class="form-input" size="10" /></td>
      <td>{{$value.click}}</td>
      <td>
      	<span class="icon-span icon-edit" onclick="editArc({{$value.id}})"><i></i>修改</span>
        <span class="icon-span icon-delete delete"><i></i>删除</span>
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
    <option value="allow">审核</option>
    <option value="mark">推荐</option>
  </select>
  <input type="button" class="btn btn-pri btn-inline" value="确定" />
  </div>
	{{$pages}}
</div>

<script src="{{$APP_PATH}}/js/jquery-1.11.3.min.js"></script>
<script src="{{$APP_PATH}}/js/jquery.form.js"></script>
<script src="{{$APP_PATH}}/js/layer/layer.js"></script>
<script src="{{$APP_PATH}}/js/layer/layui/layui.js"></script>
<script src="js/art.js"></script>
</body>
</html>
