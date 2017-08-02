
//提示框插件，表单验证时弹出提示
(function($){
	$.fn.tips = function(options){
		
		var defaults ={
					w : 160, 	//width
					h : 30,		//height
					cssName: "tips",
					txtCssName : "tipsborder",
					meg : "An error has occurred!",
					Left : 30, //离左面
					Top  : 10  //离项部
		}
		var settings = $.extend(defaults,options);
		
//		if( !$("#__tipsPop").is("div") ){
//			var _tips = $("<div id='__tipsPop'></div>");
//			if(settings.w > 0)_tips.css({width:(settings.w + "px")});
//			_tips.css( { height:(settings.h + "px"), display:"none", position:"absolute",cursor:"pointer"} );
//			_tips.addClass(settings.cssName);
//			_tips.appendTo("body");
//		}
		//显示提示信息
		layer.msg(settings.meg, {icon:5});
//		var _tips = $("#__tipsPop");
//		var _meg  = "<div style='width:"+settings.w+"px;height:"+(settings.h - 11)+"px'>";
//			 _meg += "<marquee behavior='alternate' scrollamount='3'>" + settings.meg + "</marquee>";
//			 _meg += "</div>";
//		var pos = $(this).offset();
//		var pos_left = (pos.left + settings.Left ) + "px";
//		var pos_top  = (pos.top - ($(this).height() + settings.Top) ) + "px";
//		_tips.css( {left: pos_left,top:pos_top} );
//		_tips.html("<div class='"+settings.txtCssName+"'>" + _meg + "</div>");
//		_tips.show("fast");
//		_tips.click(function(){_tips.hide(50); _tips.remove();});
//		$(this).click(function(){_tips.hide(50); _tips.remove();});
	}
	
})(jQuery);


//================================
//表单常规验证
(function($){
		  
	$.fn.verify = function(options){	
	//*-------------------------------
		
		var defaults ={
					w : 0,			//提示框宽度(像素)
					left:30,
					top:10,
					meg : "An error has occurred!",
					data : "str"		/* 
										 data参数:指文本框数据类型,即要验证什么
										 str  : 字符串,默认验证不能为空
										 date : 日期型,验证是否为日期
										 phone: 电话号码,验证是否为电话号码
										 email: 电子邮箱,验证是否为电子邮箱
										 ident: 身份证,验证是否为身份证号码
										 e_n  : 只能是英文和数字) ]，以便采用相应验证
										 number:只能为数字
										*/
					
		}
		var settings = $.extend(defaults,options);
		
		var _parent = $(this);
		var _type = $(this).attr("type");
		var _val = $.trim($(this).val());		
		switch(_type){
			case "text" :	switch(settings.data){
									case "str" 		: return isEmpty( _parent, _val );break;
									case "e_n" 		: return isEnNum( _parent, _val ); break;
									case "date"		: return isDate( _parent, _val ); break;
									case "phone"	: return isPhone( _parent, _val ) ; break;
									case "tel"		:	return isTele( _parent, _val ); break;
									case "mobile"	:	return isMobile( _parent, _val ); break;
									case "ident"	: return isIdent( _parent, _val ); break;
									case "number" : return isNumber( _parent, _val ); break;
									case "money" 	:	return isMoney(_parent, _val); break;
									case "email"	:	return isEmail(_parent,_val); break;
									default: 				return isEmpty( _parent, _val ); 
							}
							break;
			case "password" : return isEmpty( _parent, _val );break;
			case "radio" : return radioIsChecked(_parent);break;
			case "select-one" : return selectIsChecked(_parent); break;				
		}
		if( $(this).is("select") ){
			return selectIsChecked(_parent);
		}else{
			if( _type == "select-one" )	return selectIsChecked(_parent);
		}
			//==文本框相关
			function isEmpty( obj, val ){	//文本框或隐藏域:为空时返回true,不为空返回false
				val = $.trim(val);
				var _chr = /\u3000/g;
				if( _chr.test(val) ) val = val.replace(_chr,'  ');
				var _re = /\S.*/;
				if( !_re.test(val) ){
					obj.val("");
					obj.tips({meg:settings.meg});
					return true;
				} else {
					return false;
				} 
			}

			
			function isEnNum(obj, val){	//只能是英文和数字
				if(isEmpty(obj,val)){
					obj.tips({meg:settings.meg});
					return true;	//为空,表示有错误发生,返回错误为true
				}else{
					var _re = /^[A-Za-z0-9]+$/;
					if(_re.test(val)){
						return false;/*返回错误为false,即无错误*/
					} else{
						obj.tips({meg:settings.meg});
						return true;/* 有错误发生,返回错误为true */
					}
				}
			}

			function isNumber(obj, val){	//只能数字
				var _re = /^[0-9]+$/;
				if (val.length > 0 ){ 
					var nan = Math.abs(val);
					val	= isNaN(nan) ? val : nan;
				}
				if(_re.test(val) ){
					return false; //返回错误为false,即无错误
				}else{
					obj.tips({meg:settings.meg});
					return true;//有错误发生,返回错误为true	
				}
			}
			
			function isMoney(obj, val){	//只能数字
				var _re = /^([0-9]+)$|^([0-9]+\.\d{1,2})$/;
					if(_re.test(val)){
						return false;/*返回错误为false,即无错误*/
					} else{
						obj.tips({meg:settings.meg});
						return true;/* 有错误发生,返回错误为true */
					}
			}

			function isDate(obj, val){ //是否为日期格式
				var _re = /(^([1-2])\d{3,3})-([1][012]|[0][1-9]|[1-9])-([0][1-9]|[1][0-9]|[2][0-9]|[3][01]|[1-9])$/;
				if( !_re.test(val) ){obj.tips({meg:settings.meg});return true;}
			}
			
			function isPhone(obj,val){ //是否为电话号码
				var _re = /^(\d{3,4}-)?(\d{7,8})$|^(\d{11})$/;
				if( !_re.test(val) ){obj.tips({meg:settings.meg});return true;}
			}
			
			function isTele(obj,val){//是否为座机号码
				var _re = /^(\d{3,4}-)?(\d{7,8})$/;
				if( !_re.test(val) ){obj.tips({meg:settings.meg});return true;}				
			}
			
			function isMobile(obj,val){ //是否为手机号码
				var _re = /^(\d{11})$/;
				if( !_re.test(val) ){obj.tips({meg:settings.meg});return true;}
			}
			

			function isIdent(obj,val){//检查身份证号码是否正确
				var re_idc = /(^\d{15}$)|(^\d{17}([0-9]|(X|x))$)/;
				if( !re_idc.test(val) ){obj.tips({meg:settings.meg});return true;}
			}
			
			function isEmail(obj,val){
				var re_email = /^([a-zA-Z0-9_\.]+)@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/;
				if( !re_email.test(val)){obj.tips({meg:settings.meg});return true;}
			}
			//===文本框相关 Over
			
			function radioIsChecked(obj){			//单选框:未选中返回true,选中返回false
				var _checked = obj.attr("checked");
				if(!_checked){obj.tips( {meg:settings.meg} );return true;} else {return false;}
			}
			
			function selectIsChecked(obj){
				var _selected = obj.get(0).selectedIndex;
				if(_selected == 0){obj.tips( {meg:settings.meg,Left:settings.left,Top:settings.top} );return true;} else {return false;}
			}
			
	//*-------------------------		
	}	
	
})(jQuery);