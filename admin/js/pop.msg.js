//仅弹出提示框，无其他操作
(function($){
	
	$.fn.popmsg = function(options){
		var defaults = {
					msg : '',
					tiltLeft : 20, //向右偏移20像素
					tiltTop  : 20, //向上偏移20像素
					times	: 1000,
					call : ''
		}
		var settings = $.extend(defaults,options);
		
		var msgDiv = $("#__pop__msg__layer");
		msgDiv.stop();
		msgDiv.remove();
		var pos = $(this).offset();
		var pos_left = (pos.left + settings.tiltLeft ) + "px";
		var pos_top  = (pos.top - settings.tiltTop) + "px";
		msgDiv = $("<div id='__pop__msg__layer'>"+settings.msg+"</div>");
		msgDiv.css({
				position: "absolute",
				zIndex : 999,
				display	: "none",
				margin	: "auto auto",	
				padding	: "5px 10px",
				backgroundColor	: "#ffffff",
				border: '1px double #dddddd',
				color : "#ff0000",
				left : pos_left,
				top : pos_top
		});
		
		msgDiv.appendTo(document.body);
		
		msgDiv.stop(false,true).fadeIn("slow",function(){
			setTimeout(function(){
				msgDiv.stop(false,true).fadeOut("slow",function(){ 
					msgDiv.remove();
					if( $.isFunction(settings.call) ){settings.call();}
				});	
			},settings.times);		
		});
		
	}//$.fn.popmsg End
	
})(jQuery);