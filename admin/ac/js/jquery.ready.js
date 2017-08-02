function checkField(o){
	var oVal = $(o).val();
	if(!oVal || oVal.length == 0){
		$(o).siblings(".invalid").show();
	}else{
		$(o).siblings(".invalid").hide();
	}
	return oVal;
}

function del(_id,_url,msg){
	layer.confirm(msg,{
		btn: ["确定","取消"]
	},function(){
		$.get(_url,{id:_id},function(res){
			console.log(res);
			if(Number(res) == 0){
				layer.msg("删除成功！",{icon:1});
				location.reload();
			}
			if(Number(res) == 1){
				layer.msg("删除不成功！",{icon:2});
				return false;
			}
		})//ajax end
	},function(){
		
	})
}

function operator(obj, opera){
	var idStr = "";
	$(obj).find("input[type=checkbox]").each(function(){
		if($(this).prop("checked")){
			idStr += $(this).val() + ",";
		}
	})
	switch (opera){
		case "del":	
			var url = "?act=del";
			idStr = idStr.substr(0,(idStr.length - 1));
			del(idStr,url,"确定要删除选中数据吗？");
			break;
		default:
			break;
	}
}

function selectAll(o){
	$(o).find("input[name=id]").each(function(){
		if($(this).prop("checked")){
			$(this).prop("checked",false);
		}else{
			$(this).prop("checked",true);
		}
	})												 
}

function getArrList(url,s,obj,msg,val){
	$.getJSON(url,{s:s},function(jsonData){
		var str = "<option value='0'>--" + msg + "--</option>";
		$.each(jsonData,function(i,item){
			if(val == item.id)
				str += "<option value='" + item.id + "' selected>" + item.name + "</option>";
			else{
				str += "<option value='" + item.id + "'>" + item.name + "</option>";
			}
		})
		$(obj).html(str);
	})
}

function getRows(url,oId,s){
	$.ajaxSetup({async:false});
	$.getJSON(url,{id:oId,s:s},function(data){
		str = data == 1 ? "" : data[0].name;
	})
	return str;
}
