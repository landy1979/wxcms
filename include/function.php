<?php
//整数
function isInt( $n ){
	return  ( !is_numeric($n) || !(int)$n || (int)$n == 0 ) ? false : true;
}

function htmlentitydecode( $c, $js=false ){
	$s = html_entity_decode($c,ENT_COMPAT,'UTF-8'); //函数把 HTML 实体转换为字符。
	if(!$js){
		//如果不允许执行js
		$s = preg_replace( "/<\\/script>*/i", "&lt;/script&gt;", $s );//先替换结束标记
		$s = preg_replace( "/<script.*>/i", "&lt;script type=\"text/javascript\"&gt;", $s );
	}
	$s = preg_replace( "/data\/upload\//i", SITE_URL."data/upload/", $s );
	return $s;
}

//是否为日期格式， 格式如：2011-11-11
function is_date( $string ){
	$ymd = explode( '-', $string );
	if( count($ymd) != 3 )return false;
	return checkdate($ymd[1],$ymd[2],$ymd[0])?true:false;
}

//$onlydate 为true 只有日期格式,无时分秒，即2015-02-03，
function is_dateformat($date, $onlydate=false){
	$d = (!$onlydate) ? date('Y-m-d H:i:s',strtotime($date)) : date('Y-m-d',strtotime($date));
	if($date == $d ){ return true; }else{ return false; }
}

//计算两个日期之差，前一个日期为更晚一些的日期
//$bTime : 如：2015-6-3
//$sTime : 如：2014-3-9
function time_diff( $bTime, $sTime, $ch ){
	/*	
	$d	= floor( (strtotime($bTime) - strtotime($sTime) ) / 86400); 			//相关多少天
	$h	= floor( (strtotime($bTime) - strtotime($sTime)) % 86400 / 3600);		//相差多少小时
	$m	= floor( (strtotime($bTime) - strtotime($sTime) ) % 86400 / 60 );		//相差多少分钟
	$s	= floor( (strtotime($bTime) - strtotime($sTime));		//相差多少钞
	*/
	$d	= floor( ($bTime - $sTime) / 86400); 			//相关多少天
	$h	= floor( ($bTime - $sTime) % 86400 / 3600);		//相差多少小时
	$m	= floor( ($bTime - $sTime) % 86400 / 60 );		//相差多少分钟
	$s	= $bTime - $sTime;		//相差多少钞
	
	switch ( $ch ){
		case 'd' : return $d; break;
		case 'h' : return $h; break;
		case 'm' : return $m; break;
		case 's' : return $s; break;
	}
}

/** 计算两个日期之间相差月份，默认为后一个日期减去前一个日期
 * $startDate：开始日期
 * $endDate：结束日期
 * $currmonth：是否将当月计算入月份差
 * 如：2015-1和2015-4之差，如$currmonth=true,则结果为4，如$currmonth=false，则结果为3
*/
function month_diff( $startDate, $endDate, $currmonth=true ){
	//if( $startDate == 0 ){ return $diff; }
	$d1 = is_date($startDate) ? strtotime($startDate) : $startDate;
	$d2 = is_date($endDate) ? strtotime($endDate) : $endDate;
	$y1	= date( "Y", $d1 );
	$m1	= date( "m", $d1 );
	$y2	= date( "Y", $d2 );
	$m2	= date( "m", $d2 );
	$mon1	= ($y1 * 12) + $m1;
	$mon2	= ($y2 * 12) + $m2;
	$diff	= $currmonth ? ($mon2 - $mon1) + 1 : $mon2 - $mon1;
	return $diff;
}

//获取当周开始日期和结束日期，以星期一开始，星期日结束
//$time:可以是日期格式（如：2014-01-01），也可以是已经strtotime后的时间戳（如：1138614504）
//$formart:默认为false，返回未格式化的日期
//返回数组格式，如已格式化的：Array ( [0] => 2013-12-30 [1] => 2014-01-05 )
function weekStartToEnd( $time=null, $format=false ){
	$time = !isset($time) || empty($time) ? time() : $time;
	$time = is_date($time) ? strtotime($time) : $time;
	$cd = getdate( $time );
	$today = date("Y-m-d", $time);
	$cw = $cd['wday'];						//今天为星期中第几天， 0（表示星期天）到 6（表示星期六）
	$diff = $cw > 0 ? $cw - 1 : 6;
	$monday = $format ? date("Y-m-d",strtotime("$today - $diff days")) : strtotime("$today - $diff days");			//星期一
	$mday = $format ? $monday : date("Y-m-d", $monday );
	$sunday = $format ? date("Y-m-d",strtotime("$mday + 6 days")) : strtotime("$mday + 6 days");					//星期日
	return array($monday, $sunday);
}
//当前周的上一周，星期一和星期日
function weekLast($time=null, $format=false){
	$w = weekStartToEnd( $time, $format );
	$d	= $format ? $w[0] : date("Y-m-d", $w[0]);
	$monday = $format ? date("Y-m-d",strtotime("$w[0] - 7 days")) : strtotime("$d - 7 days");
	$sunday = $format ? date("Y-m-d",strtotime("$w[0] - 1 days")) : strtotime("$d - 1 days");
	return array($monday, $sunday);
}
//当前周的下一周，星期一和星期日
function weekNext($time=null, $format=false){
	$w = weekStartToEnd( $time, $format );
	$d	= $format ? $w[1] : date("Y-m-d", $w[1]);
	$monday = $format ? date("Y-m-d",strtotime("$w[1] + 1 days")) : strtotime("$d + 1 days");
	$sunday = $format ? date("Y-m-d",strtotime("$w[1] + 7 days")) : strtotime("$d + 7 days");
	return array($monday, $sunday);	
}

//根据日期获取当月开始日期和结束日期
//$time 可以是日期格式（如：2014-01-01），也可以是已经strtotime后的时间戳（如：1138614504）
//$formart:默认为false，返回未格式化的日期
//返回数组格式，如已格式化的：Array ( [0] => 2014-01-01 [1] => 2014-01-31 )
function monthStartToEnd( $time=null, $format=false ){
	$time = !isset($time) || empty($time) ? time() : $time;
	$time = is_date($time) ? strtotime($time) : $time;	
	$y		= date( "Y", $time );
	$m		= date( "m", $time );
	$days	= date( 't', $time );           						// 本月一共有多少天
	$start	= $format ? date( "Y-m-d", mktime(0,0,0,$m,1,$y) ) : mktime(0,0,0,$m,1,$y);        						// 本月开始日期
	$end	= $format ? date( "Y-m-d", mktime(23, 59, 59, $m, $days, $y )) : mktime(23, 59, 59, $m, $days, $y );	// 创建本月结束时
	return array( $start, $end );
}

//获取当天开始秒数和第二天的第一秒, 如：2014-3-5 结果为 2014-3-5 00:00:00的秒数和2014-3-6 00:00:00的秒数
//$day 日期,秒数，如：1468481655
function getdayses( $time=null ){
	$day = !isset($time) || empty($time) ? time() : $time;
	$d	= date("Y-m-d",$day);
	$today		= strtotime($d);
	$nextday	= strtotime("{$d} + 1 days");
	return array("start"=>$today,"end"=>$nextday);
}

//字符串转换为正则表达式格式
function strToRegExp( $str ){
	if( strlen($str)>0 ){
		$str = str_replace( "/", "\/", $str );
		$str = "/" . $str . "/";
	}
	return $str;
}

//---------------------------------------------
//html页面显示数据中数据时还原被convert转换的数据
//---------------------------------------------
function reconverthtml($_str){
	$s = trim($_str);
	$len = strlen($s);
	if($len == 0)return $_str;
	$s = html_entity_decode($s,ENT_COMPAT,'UTF-8'); //函数把 HTML 实体转换为字符。
	return $s;
}

function replacehtmlcontent($html){
	//替换script标签
	$s = preg_replace( "/<\\/script>*/i", "&lt;/script&gt;", $html );//先替换结束标记
	$s = preg_replace( "/<script.*>/i", "&lt;script type=\"text/javascript\"&gt;", $s );
	$s = preg_replace( "/data\/upload\//i", SITE_URL."data/upload/", $s ); //替换图片路径
	return $s;
}

//从内容字段中提取简介
function replacepic($_str){
		$s = trim($_str);
		$len = strlen($s);
		if($len == 0)return $_str;
		$s = html_entity_decode($s,ENT_COMPAT,'UTF-8'); //函数把 HTML 实体转换为字符。
		$s = preg_replace( "/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", '', $s ); //把图片标签去掉
		$s = preg_replace( "/<\\/script>*/i", "", $s );//去除script标签
		$s = preg_replace( "/<script.*>/i", "", $s );//去除script标签
		$s = trim( strip_tags($s) ); //去除HTMl,XML标签
		$s = preg_replace("{\t}", "", $s);
		$s = preg_replace("{\r\n}", "", $s);
		$s = preg_replace("{\r}", "", $s);
		$s = preg_replace("{\n}", "", $s);
		$s = preg_replace("{&nbsp;}", "", $s);
		$s = preg_replace("{　}", "", $s);
		return $s;
}

//---------------------------------------------
// 计算中文字符串长度
function utf8_strlen($string = null) {
	preg_match_all('/./us', $string, $match);
	return count($match[0]);
}
/*
* ---------------------------------------------
* 中文截取，支持gb2312,gbk,utf-8,big5 
* @param string $str 要截取的字串 
* @param int $start 截取起始位置 
* @param int $length 截取长度 
* @param string $charset utf-8|gb2312|gbk|big5 编码 
* @param $suffix 是否加尾缀
* -------------------------------------------- 
*/
function csubstr($str, $start=0, $length, $charset="utf-8", $suffix=false){
   if(function_exists("mb_substr")) { 
       if(mb_strlen($str, $charset) <= $length) return $str; 
       $slice = mb_substr($str, $start, $length, $charset); 
   }else{ 
       $re['utf-8']		= "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/"; 
       $re['gb2312']	= "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/"; 
       $re['gbk']		= "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/"; 
       $re['big5']		= "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/"; 
       preg_match_all($re[$charset], $str, $match); 
       if(count($match[0]) <= $length) return $str; 
       $slice = join("",array_slice($match[0], $start, $length)); 
   }
   if($suffix) return $slice."..."; 
   return $slice; 
} 
//---------------------------------------------
//截取字符串,从指定位置开始，截取指定个数的字符,兼容中文，数字，字符，字母
//---------------------------------------------
function substr_gb($_str, $_pos, $_len){
	$tmp = ""; $pos = $_pos; $n = 1;
	$len = strlen($_str);
	if($len == 0) return $_str;
	$_str = mb_convert_encoding($_str, 'GB2312', 'UTF-8');
	$_str = strip_tags(reconverthtml($_str));
	for( $i=$pos;$i<$len;$i++ ){
		$s = substr($_str, $pos, 1);
		if( ord($s) > 128 ){ 
			$tmp .= $s; $pos++; $tmp .= substr($_str, $pos, 1);
		}else{
			$tmp .= $s;
		}
		$pos++; $n++;
		if($n > $_len)break;
	}	
	return $tmp;
}

//手机号码中间四位以星号(*)显示
function teleToAsterisk( $tel ){
	if( strlen($tel) != 11 ){ return $tel; }
	$start	= substr($tel, 0, 3);
	$end	= substr($tel,7,4);
	return ($start . "****" . $end);
}

//---------------------------------------------
//获取ip和端口
//---------------------------------------------
function getIp(){
	$ip = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : 0;	
	$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : 0;
	if( empty($ip) ) $ip = $_SERVER["REMOTE_ADDR"];
	$port = isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : 0; 
	$ip = convert($ip);
	$port = convert($port);
	return empty($port) ? $ip : $ip . ":" . $port;
}
function getonlyip(){
	$ip = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : 0;	
	$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : 0;
	if( empty($ip) ) $ip = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : 0;
	$ip = convert($ip);
	return $ip;
}

/**
 * frompicgetpath，从图片图径中获取路径或文件名
 * 如：data/upload/product/141222/2014122214455971030-b.jpg
 * $pf=='path',返回data/upload/product/141222/
 * $pf=='name',返回2014122214455971030-b.jpg
*/
function frompicgetpath( $src, $pf='name' ){
	if( empty($src) )return '';
	if(  stripos($src,'/') == 0 ) return $src;
	$result = '';
	$s = explode( "/", $src );
	$len = count($s);
	if( $pf=='path'){
		for ($i=0;$i<$len-1;$i++){
			$result .= ($s[$i] . "/");
		}
	}elseif( $pf=='name' ){ $result = $s[$len-1]; }
	return $result;
}

/* ========================================================== */
/* 简易手机号码字符混淆 */
function confusionstr( $_str ){
	if( strlen($_str) == 0 )return $_str;
	$firstStr	= substr($_str, 0, 1);
	$letter		= "abcdefghijklmnopqrstuvwxyz";	// ABCDEFGHIJKLMNOPQRSTUVWXYZ
	$letter		= str_shuffle($letter);	//随机打乱字符顺序
	$before		= substr($letter, 0, 3);
	$after		= substr($letter, 10, 4);
	$No_1		= substr($_str,1,3);
	$No_2		= substr($_str,4,4);
	$No_3		= substr($_str,8);
	$str		= $before . strlen($No_1).$No_1 . $after . strlen($No_2).$No_2. substr($letter, 7, 5) . strlen($No_3).$No_3  . $firstStr . substr($letter, 12, 4);
	//$str : 如手机号码：18982482658，最终字符串为：abz3898miys42482tuqmi36581ysfl
	return $str;
}
/* 还原简易手机号码字符混淆 */
function recoverystr( $_str ){
	if( strlen($_str) == 0 )return $_str;
	$str = $_str;
	preg_match_all("/\d+/i", $str, $match);
	$count = count($match[0]);
	if( $count == 3 ){
		$i = 0;
		$num = array();
		foreach ( $match[0] as $s ){
			$s1 = substr( $s, 0, 1 );
			$s2 = substr( $s, 1, $s1 );
			$num[] = $s2;
			if( $i == 2 ){ $num[] = substr($s,strlen($s)-1); }
			$i++;
		}
		if( count($num) == 4 ){
			$str = $num[3] . $num[0] . $num[1] . $num[2];
		}
	}
	return $str;
}

/* ========================================================== */

/**
 * requestremote，几乎适应于所有远程接口数据的访问及提交
 * 其原理是使用curl实现向远程接口http及https协议时的get，post方式。
*/
function requestremote($url,$data = null)
{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
}

function utf2gb($str, $fromchar='utf-8', $tochar='gb2312'){
	if(!empty($str)){
		return iconv($tochar,$fromchar."//ignore",$str);
	}else{
		return "";
	}
}

function convertNULL($result){
	return isset($result) ? $result : 'NULL';
}

function convertZero($result){
	return $result ? $result : 0;
}

function toNumber($result){
	return is_numeric($result) ? $result : 0;
}

//截取字符串
function cutString($str, $len){
	if($str && strlen($str) > 0){
		return my_explode(substr($str,0,$len),",");
	}else{
		return array();
	}
}

function my_explode($str,$sign){
	return explode($sign,$str);
}

function str2NULL($str,$len){
	if(strlen($str) > 0){
		return cutString($str,$len);
	}else{

	}
}

//季度
function getQuarter($date){
	$month = date('m',$date);
	$tmpArr = array('一','二','三','四');
	$quarter = ceil($month/3);
	for($i=1;$i<=count($tmpArr);$i++){
		if(intval($quarter) == intval($i)){
			$str = $tmpArr[$i-1];
		}
	}
	return $str;
}

//拆分数字
function numberToSplit($number,$pos="-1"){
	if(!is_numeric($number)) return $number;
	$arrNum = str_split($number);
	$len = count($arrNum);
	return $pos == "-1" ? $arrNum[$len - 1] : $arrNum[$pos];
}
?>