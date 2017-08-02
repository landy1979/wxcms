<?php
//此函数用于上传图片，仅允许上传jpg,gif,png,bmp图片
//$form 表单file字段名称
//$savepath 图片保存路径
function uploadpicture( $form='', $savepath='' ){
	$msg = array('err'=>0,'file'=>'');
	$oFile	= $_FILES[$form];
	$Err	= $oFile['error'];
	$msg['err'] = $Err;
	if( $Err == 0 ){
		$oName		= $oFile['name'];
		$tmpFile	= $oFile["tmp_name"];
		if ( is_uploaded_file($tmpFile) ) {//是否是通过http上传的
			$name = replaceFileName($oName);//替换上传文件名中的特殊字符
			if(checkFileName($name)){//检查是否为图片类型
				$newName = uploadfilerename( $name );
				$path = $savepath . $newName;
				$bln = move_uploaded_file( $tmpFile, $path );//重命名上传文件名
				$Err = $bln ? 0 : 9; //返回0为成功上传,9为上传失败
				$msg['file'] = $path; //图片名，全路径
				$msg['newName'] = $newName; //仅图片名，不含路径
			}else{
				$Err = 10;//10为上传的文件非合法图片类型
			}	
		}else {
			$Err = 8;//8为非通过正常http途径上传
		}
		$msg['err'] = $Err;
	}
	return $msg; //返回msg数组
}
//替换上传文件名中的特殊字符
function replaceFileName( $s_FileName ){
	$exts	= trim($s_FileName);	
	$exts	= str_replace( chr(0),'', $exts );
	$exts	= str_replace( chr(32),'', $exts);
	$exts	= str_replace( chr(39),'', $exts);
	$exts	= str_replace( chr(34),'', $exts);
	$exts	= str_replace( '/\\n/','', $exts);
	$exts	= str_replace( '<','', $exts);
	$exts	= str_replace( '>','', $exts);
	$exts	= str_replace( '?','', $exts);
	$exts	= str_replace( '*','', $exts);
	$exts	= str_replace( '/\//','', $exts);
	$exts	= str_replace( ';','', $exts);
	$exts	= str_replace( '　','', $exts);
	$exts	= str_replace( ' ','', $exts);
	return $exts;
}
//检查是否为图片类型
function checkFileName( $s_FileName ){
	$Exts	= explode( ".", $s_FileName );
	$ext	= trim(strtolower($Exts[count($Exts)-1]));
	if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' ) {return true; }else { return false; }
}
//重命名上传文件名
function uploadfilerename( $s_FileName ){
	//随机数，重命名文件	
	$Exts	= explode( ".", $s_FileName );
	$ext	= trim(strtolower($Exts[count($Exts)-1]));
	$ran	= date("YmdHis") . mt_rand(0, 99999) ;
	$name	= $ran . "." . $ext;
	return $name;	
}
//uploadpicture函数返回值，中文提示
function uploadmsg( $err = 0 ){
	$str = '';
	switch ($err){
		case 1 :
		case 2 : 
		case 8 : $str = '文件大小超过了服务器限制大小！'; break;
		case 4 : $str = '您还没有上传文件！'; break;
		case 3 :
		case 9 : $str = '因网络原因，文件上传失败！'; break;
		case 10: $str = '上传文件不是图片类型，请上传jpg,gif,png类型图片！'; break;
		case 7 : $str = '写入文件失败，请检查服务器文件夹是否有可写入权限！'; break;
		case 0 : $str = '上传成功！'; break;
		case 11: $str = '您选择上传的图片是损毁的图片，上传失败！'; break;
	}
	return $str;
}

?>