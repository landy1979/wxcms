<?php
if(!isset($_SESSION["id"]) || $_SESSION["id"] == ""){
	exit ("<script>top.location.href='../../../admin/login.html';</script>");
}
?>