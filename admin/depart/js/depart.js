$("#form").submit(function(){
	if( $("#depname").verify({meg:"科室名称不能为空！"}) ) return false;
	var formData = $(this).serialize();

	$.ajax({
		type: "post",
		url: "?act=save",
		data: formData,
		dataType: "json",
		async:false,
		success: function(msg){
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
			}//if end
		}	//success end
	})//ajax end
	return false;
})

//科室是否显示
$(".isshow").click(function(){
	var _this = $(this);
	var url = "ajax/isshow.php";
	var id = $(this).parent().parent().find("input[name=id]").val();
	$.get(url,{id:id},function(msg){
		_html = Number(msg) == 0 ? "正常" : "停用";
		_this.toggleClass("layui-btn-danger");
		_this.html(_html);
	})
})

function edit(_id){
	location.href = "edit.php?id=" + _id;
}

//专家列表
function doclist(_id){
	location.href = "../doctor/list.php?did=" + _id;
}