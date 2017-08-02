<?php
//gbk转换为utf8
function gbk2utf8($data){
	if(is_array($data)){
		return array_map("gbk2utf8", $data);
	}
	return iconv("gbk","utf-8",$data);
}

//表单过滤
function isEscapeStr($val){
	if(get_magic_quotes_gpc()){
		$value = stripcslashes(trim($val));
	}else{
		$value = addslashes(trim($val));
	}

	return $value;
}


function fstring($str){
	$str = strtolower($str);
	$pattern = "/[^a-z0-9]{6,16}$/i";
	$str = preg_replace($pattern, "", $str);
	$str = str_replace("and", "", $str);
	$str = str_replace("execute", "", $str);
	$str = str_replace("update", "", $str);
	$str = str_replace("count", "", $str);
	$str = str_replace("chr", "", $str);
	$str = str_replace("mid", "", $str);
	$str = str_replace("master", "", $str);
	$str = str_replace("truncate", "", $str);
	$str = str_replace("char", "", $str);
	$str = str_replace("declare", "", $str);
	$str = str_replace("select", "", $str);
	$str = str_replace("create", "", $str);
	$str = str_replace("delete", "", $str);
	$str = str_replace("insert", "", $str);
	$str = str_replace("''","", $str);
	$str = str_replace(" ","",$str);
	$str = htmlspecialchars($str);
// 	$str = substr($str, 0, 12);

	return $str;
}

function cn_fstring($str){
	if(isset($str)){
		$str = str_replace("and", "", $str);
		$str = str_replace("execute", "", $str);
		$str = str_replace("update", "", $str);
		$str = str_replace("count", "", $str);
		$str = str_replace("chr", "", $str);
		$str = str_replace("mid", "", $str);
		$str = str_replace("master", "", $str);
		$str = str_replace("truncate", "", $str);
		$str = str_replace("char", "", $str);
		$str = str_replace("declare", "", $str);
		$str = str_replace("select", "", $str);
		$str = str_replace("create", "", $str);
		$str = str_replace("delete", "", $str);
		$str = str_replace("insert", "", $str);
		$str = str_replace("''","", $str);
		$str = htmlspecialchars($str);
	}
	return $str;
}

function string_replace($str,$len){
	if(strlen($str)>0){
		$str = str_replace(".","",$str);
		$str = str_replace("/","",$str);
		$str = substr($str, 0, $len);
	}
	return $str;
}

function general_num($length = 6){
	$min = pow( 10, ($length - 1) );
	$max = pow( 10, $length ) -1;
	return mt_rand($min,$max);
}

function showPop($meg){
	echo "<script>alert('".$meg."'); history.back();</script>";
	exit;
}

function backUrl($meg, $url){
	echo "<script>alert('".$meg."'); location.href=$url;</script>";
	exit;
}

function validateEmail($str){
	if(isset($str)){
		$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
		if(preg_match($pattern, $str)){
			return true;
		}else{
			return false;
		}
	}
}

function format_float($num){
	if(is_numeric($num)){
		if(strpos($num, ".")){
			$num = explode(".", $num);
			$nums = $num[0].".".$num[1];
			return floatval($nums);
		}
		return floatval($num);
	}else{
		return false;
	}
}

function strTime(){
	$time = date("H:i:s",time());
	if($time >= "00:00:00" && $time <= "07:00:00"){
		$str = "午夜";
	}elseif($time > "07:00:00" && $time < "08:30:00"){
		$str = "早上";
	}elseif($time > "08:30:00" && $time < "12:00:00"){
		$str = "上午";
	}elseif($time > "12:00:00" && $time < "14:00:00"){
		$str = "中午";
	}elseif($time > "14:00:00" && $time < "18:00:00"){
		$str = "下午";
	}elseif($time > "18:00:00" && $time < "00:00:00"){
		$str = "晚上";
	}
	return $str;
}

/* 盐值加密
参数： $password	要加密的字符串
		  $salt			随机盐值
	*/
function generateHashWithSalt($password, $salt){
	return hash("sha256", $password . $salt);
}

//获取客户端ip
function get_client_ip(){
	if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
		$ip = getenv("HTTP_CLIENT_IP");
	} else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
		$ip = getenv("REMOTE_ADDR");
	}else if (isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")){
		$ip = $_SERVER["REMOTE_ADDR"];
	}else{
		$ip = "unknown";
	}
	return $ip;
}

?>