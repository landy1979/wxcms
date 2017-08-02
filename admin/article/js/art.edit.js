//添加文章保存
$("#btn_edsave").click(function(){
	if( $("#title").verify({meg:"文章标题不能为空！"}) ) return false;
	if( $("#pcat").verify({meg:"请选择文章所在栏目！"}) ) return false;

	var formData = $("#form").serialize();
	var paths = "";
	var pics = "";
	var orders = "";
	$(".uppic").each(function(i, ele) {
    paths += $(ele).attr("data-path") + "|";
		pics += $(ele).attr("data-pics") + "|";
		orders += $(ele).attr("data-order") + "|";
  });
	formData += "&paths=" + paths + "&pics=" + pics + "&orders=" + orders;

	$.ajax({
		url:location.href + "&act=edsave",
		type:"post",
		data:formData,
		dataType:"json",
		async:false,
		success:function(msg){
			console.log(msg);
			if(Number(msg.status) == 0){
				$("#msg").fadeTo(1000,1,function(){
					var _output = {
						msg: "成功提示：[ " + msg.m + " ]",
						method: "hideMsg('#msg',1);"	
					}
					var _html = showMsg(_output);
					$("#msg").html(_html);
				});
				return false;
			}else{
				$("#msg").fadeTo(1000,1,function(){
					var _output = {
						msg: "错误提示：[ " + msg.m + " ]",
						method: "hideMsg('#msg');"
					}
					var _html = showMsg(_output);
					$("#msg").html(_html);
				});
				return false;
			}
		}
	})
})