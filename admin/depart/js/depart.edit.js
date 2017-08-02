$("#form").submit(function(){
	if( $("#depname").verify({meg:"科室名称不能为空！"}) ) return false;
	var formData = $(this).serialize();

	$.ajax({
		type: "post",
		url: "?act=edsave",
		data: formData,
		dataType: "json",
		async: msg,
		success: function(msg){
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
			}//if end
		}	//success end
	})//ajax end
	return false;
})