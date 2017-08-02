<?php
function md5str($_str){
	$str = hash( 'md5', $_str );//先把密码加密成长度为32字符的密文 
	$str1 = hash( 'md5', substr($str,0,4) );
	$str2 = hash( 'md5', substr($str,5,28) );//把密码分割成两段,分别加密后再合并
	$str = hash( 'md5', ($str1 . $str2) );//最后把长字串再加密一次，成为32字符密文
	$str = hash( 'md5', $str );
	return $str;
}
?>