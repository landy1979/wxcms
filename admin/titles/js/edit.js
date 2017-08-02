$("#form").submit(function(){
	if( $("#titlename").verify({meg:"请输入医生职称名称！"}) ) return false;
	if( $("#cost").verify({meg:"预约费用格式不合法！", data:"money"}) ) return false;
	var formData = $(this).serialize();
	$.ajax({
		type:"post",
		url: "?act=edsave",
		data:formData,
		dataType:"json",
		async:false,
		success:function(msg){
			console.log(msg.m);
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
		}//success end
	})//ajax end
	
	return false;
	
})