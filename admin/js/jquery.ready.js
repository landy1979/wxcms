function showMsg(str){
	var _html = "<span>" + str.msg + "</span>";
			_html += "<a href=\"javascript:;\" onclick=\""+str.method+"\">返回</a>";
	return _html;
}

function hideMsg(obj,mode){
	$(obj).fadeOut(2000);
	//0:提交成功，清空页面数据
	if(mode == 0){
		$("#form")[0].reset();
		$("#multi_up").html("");
		$("#upfile").attr("src",$("#upfile").attr("src"));
		if(typeof(editor) != "undefined") { editor.html(""); }
//		if(typeof(wapeditor != "undefined")) { wapeditor.html(""); }
	}
	//1:提交成功，重新加载页面
	if(mode == 1){
		location.reload();
	}
	$("#msg").html("");
}

function del(_id,url,meg){
	layer.confirm(meg,{
		btn:["确定","取消"]
	},function(){
		$.ajax({
			type:"get",
			url: url,
			data:{ id:_id, rnd: new Date().getTime() },
			dataType:"json",
			async:false,
			success:function(msg){
				console.log(msg);
				if(Number(msg.status) == 0){
					layer.msg(msg.m,{icon:1});
					setTimeout(function(){
						location.href = location.href;
					},100)
				}else{
					layer.msg(msg.m,{icon:2});
					return false
				}
			}
		})
	});
}