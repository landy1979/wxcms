<?php
require_once "../../include/config.php";
require_once "../../include/validateCode.class.php";
require_once "session.php";

$code = new ValidateCode(80,35);
$font = rand(1,6);
$code->showImage("fonts/".$font.".ttf");
$_SESSION["code"] = $code->getCheckCode();

?>