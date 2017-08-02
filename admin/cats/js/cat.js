$(function(){
	//栏目文件夹，汉字转换拼音
	$("#py").click(function(){
		var catname = $("#catname").val();
		if($(this).is(":checked")) { chineseTopinyin(catname); } else { $("#folder").val(""); }
	})
	
	//表单ajax提交，保存栏目数据
	$("#form").submit(function(){
		if( $("#catname").verify({"meg":"栏目名称不能为空！"}) ) return false;
		
		var formData = $("#form").serialize();
		$.ajax({
			type: "post",
			url: "?act=save",
			data: formData,	
			dataType: "json",
			async: true,
			success: function(msg){
//				console.log(msg);
				if(Number(msg.status) == 0){
					$("#msg").fadeTo(1000,1,function(){
						var _output = {
						msg: "成功提示：[ " + msg.m + " ]",
						method: "hideMsg('#msg',0);"	
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
		
		return false;	
		
	})
	
})
