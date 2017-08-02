<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title>{{$title}}_选择就诊医生</title>
{{* 自定义css *}}
<link href="css/common.css" rel="stylesheet">
<link href="css/res.css" rel="stylesheet">
{{* agile css *}}
<link href="{{$APP_WAP}}/js/agile/agile/css/agile.layout.css" rel="stylesheet">
<link href="{{$APP_WAP}}/js/agile/third/seedsui/plugin/seedsui/seedsui.min.css" rel="stylesheet">
</head>
<body>

<input type="text" name="depid" id="depid" value="{{$res.id}}" />

<div id="section_container">
	<section id="slider_section" data-role="section" class="active">
		<header>
<!--			<div class="titlebar">
	      <i class="back"></i>
			  <i class="home"></i>
				<h2 class="text-center">{{$res.depname}}</h2>
      </div>-->
			<div id="tabbarOuter" data-scroll="horizontal">
				<div class="scroller">
					<ul class="slidebar">
						<li class="tab active" data-role="tab" href="#page1" data-toggle="page">
							<label class="tab-label">专家预约</label>
						</li>
						<li class="tab" data-role="tab" href="#page2" data-toggle="page">
							<label class="tab-label">科室简介</label>
						</li>
					</ul>
				</div>
			</div>
		</header>
    
    <article data-role="article" id="slider_article" class="active">
			<div id="sliderPage" data-role="slider" class="full">
				<div class="scroller">
					<div id="page1" class="slide" data-role="page" data-scroll="pulldown">
						<div class="scroller">
            	<p class="placepart"><span class="pdate"></span></p><p class="placepart placework"><span class="pwork">排班日期</span></p>
							<div id="slide" class="full week_container" data-role="slider">
                <div class="week-item">一</div>
                <div class="week-item">二</div>
                <div class="week-item">三</div>
                <div class="week-item">四</div>
                <div class="week-item">五</div>
                <div class="week-item">六</div>
                <div class="week-item">日</div>
              </div>
              <div class="day_container">
								<div class="day-item"><span>10</span></div>
                <div class="day-item"><span>11</span></div>
                <div class="day-item"><span>12</span></div>
                <div class="day-item"><span>13</span></div>
                <div class="day-item"><span>14</span></div>
                <div class="day-item"><span>15</span></div>
                <div class="day-item"><span>16</span></div>
              </div>
              <div id="result" class="sch querylist"></div>
						</div>
					</div>	
					<div id="page2" class="slide" data-role="page" data-scroll="verticle">
						<div class="scroller">
							<div class="desc">
                <div class="pic"><img src="{{$res.pic}}"></div>
                <div class="desc-head">
                  <span>科室电话：<a href="tel:{{$res.phone}}">{{$res.phone}}</a></span>
                  <span>地址：{{$res.address}}</span>
                </div>
                <div class="content">{{$content}}</div>
              </div>
						</div>
					</div>
				</div>
			</div>
		</article>
	</section>
</div>      
            
{{* 页脚导航 *}}
{{include file="wap/footer_cp.tpl"}}

<script src="{{$APP_WAP}}/js/agile/third/jquery/jquery-2.1.3.min.js"></script>
{{* thire *}}
<script src="{{$APP_WAP}}/js/agile/third/iscroll/iscroll-probe.js"></script>
{{* agile lite *}}
<script src="{{$APP_WAP}}/js/agile/agile/js/agile.js"></script>
{{* app *}}
<script src="{{$APP_WAP}}/js/agile/app/js/app.seedsui.js"></script>
<script>
(function(){
	$('#slider_section').on('sectionshow', function(){
		A.Component.scroll('#tabbarOuter');
	});
	$('#slider_article').on('articleload', function(){
		A.Slider('#slide', {
			dots : 'hide'
		});			
		A.Slider('#sliderPage', {
			dots : 'hide'
		});
	});	
})(jQuery)
</script>
{{* custom *}}
<script src="{{$APP_WAP}}/js/common.js"></script>
<script src="{{$APP_WAP}}/js/date.js"></script>
</body>
</html>