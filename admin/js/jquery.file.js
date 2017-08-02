//删除已上传的文件 =================================================================
function delfile( obj, text ){
	var o 		= $(obj);
	var files 	= o.attr("data-url");
	var path 	= files.replace(/\.\.\//g,'');
	var meg		= "您确定要删除 " + text + " 吗？";
	var file 	= "../delfile.php";
		layer.open({
			title : "删除操作",
			content: meg,
			icon: 3,
			btn: ['确认', '取消'],
			shadeClose: false,
			shift : 6,
			yes: function(index){
				var layerIndex = index;
				var r = new Date().getTime() + Math.floor(Math.random()*1000);
				var postdata = { f : path, rnd : r };
				$.ajax({ type: "get", url: file, dataType:"text", async:false, data: postdata,
						success:function(data){
							alert(data);
							layer.close(layerIndex);
							var msg = Number(data) == 1 ? "删除成功！" : "删除失败...";
							$(o).popmsg({
								msg		: msg,
								call	: function(){
												if( Number(data) == 1 ){
													o.parent().remove();	
												}
										  },
								times	: 600
							});
						},//success End
						error: function(data){ alert(data.responseText);}
				})	//ajax End			
				
			}, no: function(){
				
			}
		});//layer end	
}


function ajaxUploadFile(){
	'use strict';
	var url = "../plugins/ajaxUploadFile/server/php/";

  $(".fileupload").fileupload({
        url: url,
        dataType: "json",
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
							var photo = false;
							if( file.type.indexOf("image") != -1 ){ photo = true; }
							var html = "<div class=\"uploadedfile\" data-title=\"" + file.name + "\" data-path=\"" + file.deleteUrl + "\" data-type=\"" + file.type + "\">";
							var photo = file.type.replace(/\/(png|jpg|jpeg|bmp|gif)$/,'');
							if( photo == 'image'){
								var viewUrl = file.deleteUrl.replace(/\.\.\//g,'');
								viewUrl	= "../../" + viewUrl;
								html += "<a href=\""+viewUrl+"\" target=\"_blank\" style=\"color:#09F\" class=\"photo\"><img src=\"" + viewUrl + "\"><span class=\"text\">"+file.name+"</span></a>";	
							}else{
								html += (file.name);	
							}
							html += "<span>上传成功</span>";
							html += "<input type=\"button\" class=\"btn btn-danger delete\" data-type=\""+file.type+"\" data-url=\""+file.deleteUrl+"\" value=\"删除\" onclick=\"delfile(this,'"+file.name+"',"+file.id+")\" />";
							html += "</div>";
							$(html).appendTo($("#files"));
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $("#progress .progress-bar").css(
                "width",
                progress + "%"
            );
        }
  }).prop("disabled", !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : "disabled");
}