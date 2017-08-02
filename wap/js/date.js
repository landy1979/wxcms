(function(){
	
	$(".pdate").html(format_Date(0) + "至" + format_Date(6));

	drawlist(format_Date(0));
	
	var cells = $(".day_container > .day-item");
	var clen = cells.length;
	var currentFirstDate;
	var dt = new Date();
			today = dt.getDate();			//获取当前日期
		
	var formatDate = function(date){
		var year = date.getFullYear() + "年";
		var month = date.getMonth() + 1 + "月";
		var day = date.getDate();
		var week = "(" + ["星期天一","星期二","星期三","星期四","星期五","星期六","星期天"][date.getDay()] + ")";
		
		return day;
	}
	
	var addDate = function(date,n){
		date.setDate(date.getDate() + n);
		return date;
	}
	
	var setDate = function(date){
		var week = date.getDay();
		date = addDate(date,week*0);
		currentFirstDate = new Date(date);
		for(var i = 0;i<clen;i++){
			_date = formatDate(i == 0 ? date : addDate(date,1));
    	cells[i].getElementsByTagName("span")[0].innerHTML = _date;
			var mydate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + _date;
			var myweek = date.getDay();
			cells[i].setAttribute("date",mydate);
      if (cells[i].getElementsByTagName("span")[0].innerHTML == today) {
      	cells[i].getElementsByTagName("span")[0].className += ' curday';
				cells[i].getElementsByTagName("span")[0].className += ' active';
				week = week == 0 ? 7 : week;
				cells[i].style.marginLeft = (100 / 7) * (week - 1) + "%";			 //当天日期距左边距离
      };
    }

	};

	setDate(new Date());

	function drawlist(mydate){
		var depid = $("#depid").val();

		var url = "json/get.sch.php";
		var html = "<ul>";
		$.ajax({
			type: "get",
			url: url,
			data:{
				depid: depid,
				date: mydate,
				rnd: new Date().getTime()
			},
			dataType: "json",
			async: false,
			success: function(jsonData){
				if(jsonData.length == 0) { 
					html = "<p><img src=\"imgs/nobg.png\"><span>没有找到当天排班的医生</span></p>";
					$("#result").html(html);
				}
				$.each(jsonData,function(i,item){
					var daypart = "";
					for(var i=0;i<item.daypart.length;i++){
						var style = item.work == 4 ? "reset" : "";
						daypart += "<span class=\"day_part inline-block " + style + "\">"+ item.daypart[i] +"</span>";
					}
					html += "<li>";
					if(item.work != 4){
						html += "<a href=\"#\"></a>";	
					}
					html += "<div class=\"logo\"><span><img src=\""+ item.logo +"\"></span></div>";
					html += "<div class=\"info\"><h2>"+ item.doctor + daypart +"</h2><span class=\"titname\">"+ item.title +"<\/span></div>";
					html += "<div class=\"overleft\">剩"+ item.docid +"</div>";
					html += "<div class=\"divline\"></div>";
				})
				html += "</ul>";
				$("#result").html(html);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);	
			}
		})			
	}

	$(".day-item").bind("click",function(){
		$(this).children("span").addClass("active");
		$(this).siblings().children("span").removeClass("active");
		var mydate = $(this).attr("date");
		var myweek = $(this).attr("week");
		drawlist(mydate);
	})
	
})(jQuery)