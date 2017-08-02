function format_number(num,len){
	if(num){
		if(num.toString().indexOf(".") > 0){
			var tmpNum = num.toString().split(".");
			return tmpNum[0] + "." + tmpNum[1].substring(0,len);
		}else{
			return num;	
		}
	}
}

//只能数字
function isNumber(val){	
	var _re = /^[0-9]*[1-9][0-9]*$/;
		if(_re.test(val)){
			return true;/*返回错误为false,即无错误*/
		} else{
			return false;/* 有错误发生,返回错误为true */
		}
}

//隔行换行
function odd(dom){
	var _size = $(dom).size();
	if(Number(_size) > 0){
		for(var i=0;i<_size;i++){
			if(i%2!=0){
				$(dom).eq(i).addClass("bluerow");	
			}
		}
	}
}

//检测手机号
function checkMobile(str){
	var re = /^(13[0-9]{9})|(15[89][0-9]{8})|(18[0-9]{9})$/;
	if(!re.test(str) || str.length != 11){ 
		return true;				//无效
	}else{
		return false;				//有效
	}	
}

//检测Email地址
function checkEmail(str){
	var re = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	if(!re.test(str)){
		return true;					//无效
	}else{
		return false;					//有效
	}
}

//php时间截转换为日期
function php2Time(time){
	if(time > 0){
		var dateStr = new Date(time * 1000);
		return dateStr.getFullYear() + '-' + (dateStr.getMonth() + 1) + '-' + dateStr.getDate();
	}else{
		return 0;	
	}
}

function _delRow(_id, url, meg, meg2){
	layer.confirm(meg,{
		btn: ["确定", "取消"]
	},function(){
		$.get(url,{id:_id}, function(msg){
			if( Number(msg)==1 ){
				$(this).attr("disabled","disabled");
				layer.msg("删除成功！",{icon:1});
				setTimeout(function(){
					location.reload();
				},1000);
				return false;
			}else if(Number(msg) == 3){
				layer.msg(meg2,{icon:2});
				return false;
			}else{
				layer.msg("删除失败！",{icon:2});
				return false;					
			}
		})
//		layer.msg("确定",{icon:1})	;
	},function(){
		layer.close();	
	})
}

///当天时间
function today(){
	var td = new Date();
	var year = td.getFullYear();
	var month = td.getMonth() + 1;
	var date = td.getDate();
	date = String(date).length == 1 ? "0" + date : date;
	return year + "-" + month + "-" + date;
}

//去掉空格
function trim(str){
	if(str != ""){
		reg = /(\s+)|(\s+$)/g;
		return str.replace(reg,"");
	}else{
		return str;	
	}
}

//计算日期差天数 
function dayDiff(date1,date2){
	if(date2 != 0){
		var dt1 = new Date(Date.parse(date1.replace(/-/g,"/")));
		var dt2 = new Date(Date.parse(date2.replace(/-/g,"/")));
		var diff = dt2.getTime() - dt1.getTime();
		return diff;
	}else{
		return 0;	
	}
}

function errShow(obj, isShow, message){
	if(isShow) {
		obj.css("display", "");	
		obj.html("<i></i>" + message);
	}	else {
		obj.css("display", "none");
		obj.html("<i></i>" + message);
	}
}

function curUrl(){
	var url = window.location.pathname;
	return url.replace(/^.*\//,'');
}

$(function(){
	$("#list").find("tr").bind("mouseenter",function(){
		$(this).find("td").css("background","rgb(227,244,251)");
	})
	.bind("mouseleave",function(){
		$(this).find("td").css("background","rgb(247,252,255)");
	})
})
