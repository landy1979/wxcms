window.onload = function(){
	var img = $("img");
	if(img.size() > 0){
		img.each(function(i, ele) {
			var imgW = $(ele).width();
			var imgH = $(ele).height();
			if(parseInt(imgW) > 480){
				$(ele).css("width","480");
			}
			$(ele).css({
				display:"block",
				margin:"0 auto"
			})
		});
	}	
}
