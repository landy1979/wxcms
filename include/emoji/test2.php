<?php
include_once( "../../config.php" );
include_once( "../cls_mysql.php" );
include_once( "emoji.php" );
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="MobileOptimized" content="320"/>
<title>泸州配送联盟</title>
<link href="emoji.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php

$s = "\"\u778c\u7761\u7684\ud83d\udc94 \u5f88\"";
$s = "瞌睡的\ue023 很";

	//$s = json_decode($s);

$s = emoji_unified_to_html($s);

$db = new mysql();

//$db->sqlexe( "Insert Into `test`(emoji) values('{$s}')" );

echo $s;

?>

</body>
</html>