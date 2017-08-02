<?php
require dirname(__DIR__) . "../../include/config.php";
require APP_ADM . "/inc/session.php";

unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["truename"]);

exit ("<script>top.location.href='../login.html';</script>");
?>