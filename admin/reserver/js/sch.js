$("#form").submit(function(){
	if( $("#resnum1").verify({meg:"预约格式不正确!",data:"number"}) ) return false;
	if( $("#resnum2").verify({meg:"预约格式不正确!",data:"number"}) ) return false;
	if( $("#d4321").verify({meg:"排班起始时间格式不正确！",data:"date"}) ) return false;
	if( $("#d4322").verify({meg:"排班起始时间格式不正确！",data:"date"}) ) return false;
	
	var formData = $(this).serialize();

	$.ajax({
		type:"post",
		url:"?act=save",
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
				})
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
	return false;	
})

function edit(_did,_id){
	location.href = "../reserver/sch.edit.php?did=" + _did + "&id=" + _id;	
}