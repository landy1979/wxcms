<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta charset="utf-8" />
<link href="css/common.css" rel="stylesheet">
<link href="css/res.css" rel="stylesheet">
<title>{{$title}}</title>
</head>

<body onLoad="loaded()">


{{* 栏目头部 *}}
<header>
	<div class="titlebar">
    <i class="back"></i>
    <i class="home"></i>
    <h2>就诊科室</h2>
  </div>
</header>

<div id="wrapper">
	<div id="scroller" class="deplist">
		<ul>
    {{foreach from=$list item=value}}
    	<li data-id="{{$value.id}}">
      	<a href="choosedoctor.php?depid={{$value.id}}"></a>
        <div class="dep_txt">
	      	<span class="title">{{$value.depname}}</span>
          <span class="phone">科室电话：{{$value.phone}}</span>
          <span class="nums">可预约医生数：{{$value.nums}}</span>
        </div>
        <div class="cls"></div>
      </li>
    {{/foreach}}
    </ul>
  </div>
</div>

{{* 页脚导航 *}}
{{include file="wap/footer_inside.tpl"}}

<script src="{{$APP_WAP}}/js/agile/third/jquery/jquery-2.1.3.min.js"></script>
{{* custom *}}
<script src="{{$APP_WAP}}/js/common.js"></script>
{{* iscroll *}}
<script src="js/iScroll/iscroll.js"></script>
<script>
//swiper
var myScroll;

function loaded () {
	myScroll = new IScroll('#wrapper', {
		mouseWheel: true,
		scrollbars:	false,
		click: true
	});
}
</script>
</body>
</html>