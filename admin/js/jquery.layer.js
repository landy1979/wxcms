/*
���ܣ���ǰ���ڵ���iframe
������
		_title ����iframe����
		ifra	 ������iframe�ļ�
		_w		 ���
		_h		 �߶�
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
���ܣ���ǰ���ڵ�����
������
		_title ������ı���
		obj ����������DOM
		_w ���
		_h �߶�
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