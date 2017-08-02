$(".home").bind("click",function(){
	location.href = "index.php";
})
$(".back").bind("click",function(){
	history.back();
})

//返回指定日期
function format_Date(intDay){
	var dt = new Date();
	var str = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + (dt.getDate() + intDay);
	
	return str;
}