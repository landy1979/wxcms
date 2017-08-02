<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/menu.css" type="text/css" rel="stylesheet" />
<script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
</head>

<body>
<div id="tabbar">
<p><span id="menu-tab">导航栏</span></p>
</div>
<div class="menu-div">
	<ul>
  	<li><span target="body-main">文章管理</span>
    	<ul class="smenu">
 				<li><a href="cats/add.php" target="body-main">添加栏目</a></li>
        <li><a href="cats/list.php" target="body-main">栏目列表</a></li>
      	<li><a href="article/art.add.php" target="body-main">添加文章</a></li>
        <li><a href="article/art.list.php" target="body-main">文章列表</a></li>
      </ul>
		</li>
    <li><span target="body-main">医院管理</span>
    	<ul class="smenu">
      	<li><a href="depart/list.php" target="body-main">科室管理</a></li>
        <li><a href="doctor/list.php" target="body-main">医生管理</a></li>
        <li><a href="titles/list.php" target="body-main">职称管理</a></li>
        <li><a href="reserver/sch.list.php" target="body-main">医生排班管理</a></li>
        <li><a href="reserver/res.list.php" target="body-main">预约管理</a></li>
      </ul>
    </li>
    <li><span target="body-main">系统管理</span>
    	<ul class="smenu">
      	<li><a href="javascript:void(0);" target="body-main">管理员列表</a></li>
        <li><a href="javascript:void(0);" target="body-main">留言管理</a></li>
      </ul>
    </li>
  </ul>
</div>

<script src="js/jquery.menu.js"></script>
</body>
</html>