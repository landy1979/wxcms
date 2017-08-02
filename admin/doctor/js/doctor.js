$("#form").submit(function(){
	if( $("#docname").verify({meg:"医生姓名不能为空！"}) ) return false;
	var formData = $(this).serialize();

	$.ajax({
		type: "post",
		url: "?act=save",
		data: formData,
		dataType: "json",
		async: msg,
		success: function(msg){
			console.log(msg);
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

//专家状态
$(".isshow").click(function(){
	var _this = $(this);
	var url = "ajax/isallow.php";
	var id = $(this).parent().parent().find("input[name=id]").val();
	$.get(url,{id:id},function(msg){
		_html = Number(msg) == 1 ? "在职" : "离职";
		_this.toggleClass("layui-btn-danger");
		_this.html(_html);
	})
})

if(!$("depid") || $("#depid").val() == 0){
	$("#depid").val($("#depart").val());
}

$("#depart").bind("change",function(){
	var depid = $(this).val();
	$("#depid").val(depid);		
})

function edit(_id){
	location.href = "edit.php?id=" + _id;
}

//专家预约
function reslist(_id){
	location.href = "../reserver/sch.add.php?id=" + _id;
}

//排班信息
function schlist(_id){
	location.href = "../reserver/sch.list.php?did=" + _id;	
}