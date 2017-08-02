<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta charset="utf-8" />
<link href="css/common.css" rel="stylesheet">
<link href="js/swiper/css/swiper.min.css" rel="stylesheet">
<title>{{$title}}</title>
</head>

<body>

{{* 轮播图 *}}
<div class="swiper">
	<div class="logo"><img src="{{$APP_WAP}}/imgs/logo.png"></div>
	<div class="swiper-wrapper">
		<div class="swiper-slide"><img src="{{$APP_WAP}}/imgs/w1.jpg"></div>
		<div class="swiper-slide"><img src="{{$APP_WAP}}/imgs/w2.jpg"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>

{{* 导航面板 *}}
<div class="panel">
	<div class="panel-box about">
  	<a href="article.php?id=29"></a>
  	<i><img src="{{$APP_WAP}}/imgs/p1.png"></i>
    <span>医院概况</span>
  </div>
  <div class="panel-box news">
  	<a href="list.php?id=14"></a>
  	<i><img src="{{$APP_WAP}}/imgs/p2.png"></i>
    <span>新闻中心</span>
  </div>
  <div class="panel-box guide">
  	<i><img src="{{$APP_WAP}}/imgs/p3.png"></i>
    <span>就医指南</span>
  </div>
  <div class="panel-box party">
  	<i><img src="{{$APP_WAP}}/imgs/p4.png"></i>
    <span>党建专栏</span>
  </div>
  <div class="panel-box news">
  	<i><img src="{{$APP_WAP}}/imgs/p5.png"></i>
    <span>文化建设</span>
  </div>
  <div class="panel-box news">
  	<i><img src="{{$APP_WAP}}/imgs/p6.png"></i>
    <span>便民服务</span>
  </div>
</div>

{{* 页脚导航 *}}
{{include file="wap/footer.tpl"}}

<script src="js/swiper/js/swiper.min.js"></script>
<script>
var swiper = new Swiper('.swiper',{
	loop: true,
	autoplay: 3000,
	pagination: '.swiper-pagination'
});
</script>
</body>
</html>