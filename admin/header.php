<?php
require_once "../include/config.php";
require_once APP_ADM . "/inc/session.php";
require_once APP_ADM . "/inc/checksession.php";
include APP_ADM . "/inc/commFunction.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/common.css" type="text/css" rel="stylesheet" />
<link href="css/header.css" type="text/css" rel="stylesheet" />
<link href="../js/layer/layui/css/layui.css" rel="stylesheet" />
<style>
body { background:url(images/top_bg.jpg) repeat-x; height:58px; border-bottom:1px solid #e4e4e4;}
</style>
</head>

<body>

<div class="header-div">
	<div class="logo"><img src="images/logo.png" width="231" height="58" /></div>
  <div class="login-info">
  	<span>欢迎<i><?php echo $_SESSION['truename'] ?></i></span>登录系统<a href="login/logout.php">退出</a>
    <div><input type="button" name="clear" value="清除缓存" class="layui-btn layui-btn-mini layui-btn-warm" onclick="clearCache();"></div>
  </div>
  <div class="cls"></div>
</div>
<div class="mbg">
	<div class="menu">
  	<span data-src="home" class="cur">首页</span>
    <span data-src="article">文章管理</span>
    <span data-src="hospital">医院管理</span>
    <span data-src="config">系统管理</span>
  </div>
</div>
<script src="../js/jquery-1.11.3.min.js"></script>
<script>
function clearCache(){
	var url = "inc/clearCache.php";
	if(confirm("确定要清除缓存吗？")){
		$.get(url,{rnd:new Date().getTime()},function(msg){
			if(Number(msg) == 0){	alert("缓存清理完毕！"); }
		})
	}
}
</script>
</body>
</html>