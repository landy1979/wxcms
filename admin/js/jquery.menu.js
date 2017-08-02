$(function(){
	$(".menu-div > ul > li > span").bind("click",function(){
		var _this = $(this);
		var _li = _this.parent("li");
		_li.toggleClass("expand");
		var _ul = $("> .smenu", _li);
		if(_ul.children("li").size() > 0){
			if(_ul.css("display") == "none"){
				_this.css("background","url(images/li_arrow.jpg) no-repeat 0 0");
				_ul.slideDown("fast");
			}else if(_ul.css("display") == "block"){
				_this.css("background","url(images/li_arrow2.jpg) no-repeat 0 0");
				_ul.slideUp("fast");
			}
		}
	})
})