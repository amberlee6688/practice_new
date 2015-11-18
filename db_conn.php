<?php
	$link = mysql_connect("localhost","root","");
	mysql_select_db("login_test",$link);
	mysql_query("SET NAMES UTF8");
	date_default_timezone_set("Asia/Taipei");
?>