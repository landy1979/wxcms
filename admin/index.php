<?php
require_once "../include/config.php";
require_once "inc/session.php";
require_once "inc/checksession.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>

<noscript>
<div style="background:#000000; border:2px solid #ccc; color:#FFFFFF; padding: 10px; line-height: 20px; position: absolute; top: 0px; font-family:'宋体'; font-size:12px; background-color: #333333;">
  <p style="font-weight: bold;">提示：您需要开启Javascript</p>
  <p>检测到您使用的浏览器不支持脚本语言(javascript)，或该功能已被禁用。</p>
  <p>要正常访问本站，您需要开启浏览器的脚本(javascript)功能，然后重试。</p>
</div>
</noscript>
<frameset rows="89,*" frameborder="0" framespacing="0" border="0">
	<frame id="frame-header" name="frame-header" src="header.php" frameborder="0" scrolling="no" />
  <frameset cols="250,6,*" frameborder="0" framespacing="0" border="0" id="frame-body">
  	<frame id="body-left" name="body-left" src="left.php" frameborder="0" scrolling="yes" />
    <frame id="body-drag" name="body-drag" src="drag.html" frameborder="0" scrolling="no" />
    <frame id="body-main" name="body-main" src="article/art.list.php" frameborder="0" scrolling="yes" />
  </frameset>
</head>

<body>
</body>
</html>