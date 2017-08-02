<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{{$title}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta name="keyword" content="{{$keyword}}" />
<link href="css/common.css" rel="stylesheet">
<link href="css/list.css" rel="stylesheet">
<link href="js/swiper/css/swiper.min.css" rel="stylesheet">
</head>

<body onLoad="loaded()">
<input type="hidden" value="{{$catid}}">

{{* 新闻轮播 *}}
<div class="swiper news-swiper">
	<div class="swiper-wrapper">
	  {{foreach from=$pics item=value}}
  	<div class="swiper-slide">
    	<a href="article.php?id={{$value.id}}">
    	<img src="{{$APP_PATH}}/{{$value.titlepic}}">
    	<span class="title">{{$value.title}}</span>
      </a>
    </div>
    {{/foreach}}
  </div>
  <div class="swiper-pagination"></div>
</div>

<div class="wrap_list" id="wrapper">
<div id="scroller">
	<ul>
  	{{foreach from=$list item=value}}
    <li><a href="article.php?id={{$value.id}}"></a>
    	{{if $value.titlepic}}
    	<div class="nl">
      	<div class="titpic"><img src="{{$APP_PATH}}/{{$value.titlepic}}" alt="{{$value.title}}"></div>
      </div>
      {{/if}}
      <div class="nr" {{if !$value.titlepic}} style="width:100%;" {{/if}}>
      	<h6>{{$value.title|truncate:30}}</h6>
        <div class="desc">
        {{if $value.titlepic}}
        {{$value.desc|truncate:30}}
        {{else}}
        {{$value.desc|truncate:100}}
        {{/if}}
        </div>
        <div class="adate">{{$value.addtime|date_format:'%Y-%m-%d'}}</div>
      </div>
      <div class="cls"></div>
    </li>
    {{/foreach}}
  </ul>
</div>
</div>

{{include file="wap/footer_inside.tpl"}}
<script src="{{$AP_PATH}}/js/jquery-2.1.3.min.js"></script>
<script src="js/common.js"></script>
<script src="js/list.js"></script>
{{* swiper *}}
<script src="js/swiper/js/swiper.min.js"></script>
<script>
var swiper = new Swiper('.swiper',{
	loop: true,
	autoplay: 3000,
	pagination: '.swiper-pagination'
});
</script>
{{* IScroll *}}
<script src="js/iScroll/iscroll.js"></script>
<script>
var myScroll;

function loaded () {
	myScroll = new IScroll('#wrapper', { bounceEasing: 'elastic', bounceTime: 1200, click: true });
}
</script>

</body>
</html>