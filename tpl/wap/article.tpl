<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{{$title}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta name="keyword" content="{{$res.keyword}}" />
<link href="css/common.css" rel="stylesheet">
<link href="css/arc.css" rel="stylesheet">

</head>

<body>

<input type="text" name="arcId" id="arcId" value="{{$res.id}}">
<input type="text" name="catId" id="catId" value="{{$res.catid}}">

<header>
	<div class="titlebar">
    <i class="back"></i>
    <h2>{{$res.catname}}</h2>
  </div>
</header>

<div id="wrapper">
	<div class="title">
  	<h2>{{$res.title}}</h2>
  </div>
  {{if $res.id != 29}}
  <div class="attr">
  	<span>文章来源：{{$res.source}}</span><span>作者：{{$res.writer}}</span><span>日期：{{$res.addtime|date_format:'%Y-%d-%m'}}</span>
  </div>
  {{/if}}
  <div class="content">{{$res.body}}</div>
</div>

<script src="{{$AP_PATH}}/js/jquery-1.11.3.min.js"></script>
{{* custom *}}
<script src="js/common.js"></script>
<script src="js/arc.js"></script>

</body>
</html>