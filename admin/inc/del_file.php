<?php
//删除单个文件
function deleteFile( $filePath="" ){
	if(strlen($filePath)>0){
		if( stripos( $filePath, "\/\/") || stripos($filePath,":") || stripos($filePath,"\\") )return;
		$filePath = str_replace("../../../../","/",$filePath);
		$fp = APP_PATH . "/" . $filePath;
		if( @file_exists($fp) )unlink($fp);
	}
}
//拆分字符串，删除多个文件
function deletemutliFile( $pathStr="", $chrStr="|" ){
	if(stripos($pathStr,$chrStr)){
		$files = explode( $chrStr, $pathStr );
		$size = count($files);
		if($size == 0)return ;
		for ($i=0; $i<$size; $i++){
			deleteFile( $files[$i] );
		}
	}else {
		deleteFile( $pathStr );
	}
}



?>