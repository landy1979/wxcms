$("#u").focus();

$("#btn_login").click(function(){

	if( $("#u").verify({meg:"用户名不能为空！"}) ) return false;
	if( $("#p").verify({meg:"密码不能为空！"}) ) return false;
	if( $("#c").verify({meg:"验证码不能为空！"}) ) return false;
	
	var formData = $("#form").serialize();
	
	$.ajax({
		type: "post",
		url: "login/check.login.php",
		data: formData,
		dataType: "text",
		async: false,
		success: function(msg){
			console.log(msg);
			switch(Number(msg)){
				case 0:
					layer.msg("请稍候，正在跳转到管理系统...",{icon:1});
					setTimeout(function(){
					window.location.href = "index.php";
				},500);	
				break;
				case 1:
					layer.msg("信息输入不完整，请重新输入",{icon:2});
					$("#u").focus();
					break;
				case 2:
					layer.msg("用户名或密码不正确，请重新输入",{icon:2});
					$("#u").focus();
					break;
				case 3:
					layer.msg("验证码不正确，请重新输入",{icon:2});
					$("#c").focus();
					break;
				case 4:
					layer.msg("该用户已被停止使用，请联系管理员",{icon:2});
					$("#u").focus();
					break;
			}//switch end
		}
	})
	
	return false;
	
})