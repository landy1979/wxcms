$("#searchForm").submit(function(){
	var ty = $("#ty").val();
	var key = $("#keyword").val();
	location.href = location.pathname + "?ty=" + ty + "&key=" + key;
	$("#keyword").val(key);
})
	
//文章审核
$(".isallow").click(function(){
	var _this = $(this);
	var url = "ajax/isallow.php";
	var id = $(this).parent().parent().find("input[name=id]").val();
	$.get(url,{id:id},function(msg){
		_html = Number(msg) == 0 ? "未通过" : "通过";
		_this.toggleClass("layui-btn-danger");
		_this.html(_html);
	})
})

//删除文章
$(".delete").click(function(){
	var _this = $(this);
	var url = "ajax/delete_arc.php";
	var id = $(this).parent().parent().find("input[name=id]").val();
	layer.confirm("确定要删除该文章吗？",{
		btn:["确定","取消"]
	},function(){
		$.get(url,{id:id,dt:new Date().getTime()},function(msg){
			if(Number(msg) == 0){
				layer.msg("文章删除成功！",{icon:1});
				location.reload();
			}
		})			
	});
})

//修改文章
function editArc(aid){
	location.href = "art.edit.php?id="+aid;
}

//图片排序
function picorder( o ){
	var div = $(o).parent('div').parent();
	var old_v = div.attr("data-order");
	var new_v = $(o).val();
	if( !$.isNumeric(new_v) ){ 
		$(o).popmsg({msg:'顺序号必须为数字！'});
		$(o).val(old_v);
		return;
	}
	div.attr("data-order",new_v);
}

function getpicpaths( oDiv ){
		var path = oDiv.attr("data-path");
		path = path.replace(/\.\.\//g,'');
		var pics = oDiv.attr("data-pics");
		var pic = pics.split(",");
		for(var i=0;i<pic.length;i++){ pic[i]	= path + pic[i]; }
		picPaths = pic.join("|");
		return picPaths;
}
//左移图片
function leftuppic(o){
	var pDiv = $(o).parent().parent("div");
	var index = parseInt(pDiv.attr("data-index"));
	var order = parseInt(pDiv.attr("data-order"));
	if(index > 0){
		var className = pDiv.attr("class");
		var curUp = $("."+className).eq(index);
		var leftUp = $("."+className).eq(index-1);
		pDiv.attr("data-index",index - 1);
		pDiv.prev().attr("data-index",index);
		pDiv.find("input[type=text]").val(index);
		pDiv.prev().find("input[type=text]").val(index+1);
		pDiv.attr("data-order",index);
		pDiv.prev().attr("data-order",index + 1);
		curUp.insertBefore(leftUp);	
	}
}
//右移图片
function rightuppic(o){
	var pTd = $(o).parent().parent().parent("td");
	var len = parseInt(pTd.children("div").size());
	var pDiv = $(o).parent().parent("div");
	var index = parseInt(pDiv.attr("data-index"));
	var order = parseInt(pDiv.attr("data-order"));
	if(index < len - 1){
		var className = pDiv.attr("class");
		var curUp = $("."+className).eq(index);
		var rightUp = $("."+className).eq(index+1);
		pDiv.attr("data-index",index+1);
		pDiv.next().attr("data-index",index);
		pDiv.find("input[type=text]").val(order+1);
		pDiv.next().find("input[type=text]").val(order);
		pDiv.attr("data-order",order+1);
		pDiv.next().attr("data-order",order);
		curUp.insertAfter(rightUp);
	}
}

//删除图片
function deleteuppic(o){
	if(confirm("您确认要删除吗?")){
		var pDiv = $(o).parent().parent("div");
		var _path = pDiv.attr("data-path");
		var _pics = pDiv.attr("data-pics");
		var _picId = pDiv.attr("data-picId");
		if( !_picId ) _picId = 0;
		var _isfirst = pDiv.attr("data-isfirst");
		if( !_isfirst ) _isfirst = 0;
		var _data = { path : _path , pics : _pics, picid : _picId, isfirst : _isfirst, rnd : new Date().getTime() + Math.floor(Math.random()*1000) };
		$.ajax({ type: "get", url: "ajax/delete_pic.php", dataType:"text",data: _data, async:false,
			success:function(result){
				if( !$.isNumeric(result) ){alert("操作失败，请重试!"); return;}
				if( Number(result) == 1 ){
					var parents = pDiv.parent();
					pDiv.remove();
					var _input = parents.find('input');
					if( _input.size() > 0 ){
						$("#multi_up > div").each(function(index, element) {
                            $(element).attr("data-order", (index+1) );
														$(element).attr("data-index", (index) );
                        });
						_input.each(function(index, domEle){ $(domEle).val( index + 1 );})
					}
					
				}
			} //seccess End
		}) //ajax End
	}
}