<?php
//获取URL中传递的变量
function geturl( $name ){  return isset($_GET[$name]) ? $_GET[$name] : ''; }

//获取表单项
function getPost( $name ){ return (isset($_POST[$name])) ? $_POST[$name] : ''; }

//获取cookies
function getcookies( $name ){  return isset($_COOKIE[$name]) ? $_COOKIE[$name] : ''; }
//---------------------------------------------
//过滤单行文本框或url提交数据
//---------------------------------------------
function convertTextbox($_str){	return convert($_str); }
//---------------------------------------------
//过滤提交数据
//---------------------------------------------
function convert($_str){
	$s = trim($_str);
	$len = strlen($s);
	if($len == 0)return $_str;
	$s = htmlentities($s,ENT_QUOTES,"UTF-8");//函数把 HTML 字符转换为实体。
	return $s;
}
function convertchr( $_str ){
	$str = str_replace( PHP_EOL, "<br />", $_str ); //回车换行转为br 
	return $str;
}
function converthtmltochr( $_str ){
	$str = str_replace( "<br />", PHP_EOL, $_str );	//br转为回车
	return $str;
}

//---------------------------------------------
//过滤sql敏感词
//---------------------------------------------
function sensitivewords( $_str ){
	$bln = false;
	if( stripos($_str,"and") )	$bln = true;
	if( stripos($_str,"or") )	$bln = true;
	if( stripos($_str,"=") )	$bln = true;
	return $bln;
}

//解码javascript escape编码
function unescape($escstr){   
    preg_match_all("/%u[0-9A-Za-z]{4}|%.{2}|[0-9a-zA-Z.+-_]+/", $escstr, $matches);   
    $ar = &$matches[0]; 
    $c = "";   
    foreach($ar as $val)   {   
        if (substr($val, 0, 1) != "%")   {   
            $c .= $val;   
        }elseif (substr($val, 1, 1) != "u")   {   
            $x = hexdec(substr($val, 1, 2));   
            $c .= chr($x);   
        }else  {   
            $val = intval(substr($val, 2), 16);   
            if ($val < 0x7F) // 0000-007F   
            {   
                $c .= chr($val);   
            } elseif ($val < 0x800) // 0080-0800   
            {   
                $c .= chr(0xC0 | ($val / 64));   
                $c .= chr(0x80 | ($val % 64));   
            }    
            else // 0800-FFFF   
            {   
                $c .= chr(0xE0 | (($val / 64) / 64));   
                $c .= chr(0x80 | (($val / 64) % 64));   
                $c .= chr(0x80 | ($val % 64));   
            }    
        }    
    }
    if(empty($c) || $c == "") $c = $escstr;  
    return $c;   
} 


//---------------------------------------------
//js弹出信息提示框，$back为数字时，history.go($back)
//---------------------------------------------
function alertpop( $msg='', $back='' ){
	$str = "<script type='text/javascript'>";
	$str .= "alert('{$msg}');";
	if( is_numeric($back) ){$str .= "history.go({$back});"; }else {$str .= "location.href='{$back}';";}
	$str .= "</script>";
	echo  $str;
	exit();
}


?>