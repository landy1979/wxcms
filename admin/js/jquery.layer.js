/*
功能：当前窗口弹出iframe
参数：
		_title 弹出iframe标题
		ifra	 弹出的iframe文件
		_w		 宽度
		_h		 高度
*/
function openFra(_title, ifra, _w, _h){
	layer.open({
		type: 2,
		title: _title,
		shadeClose: false,
		shade: 0.5,
		maxmin: true,
		area: [_w, _h],
		content: ifra,
	});
}

/*
功能：当前窗口弹出层
参数：
		_title 弹出层的标题
		obj 弹出层的外层DOM
		_w 宽度
		_h 高度
*/
function openHtml(_title, obj, _w, _h){
	layer.open({
		type: 1,
		title: _title,
		fixed: true,
		shadeClose: false,
		shade: 0.5,
		area: [_w, _h],
		maxmins: false,
		content: $(obj),
	});
}