<?php 
	//資料庫主機設定
	$db_host = "localhost";//主機名稱
	$db_table = "map";//資料庫名稱
	$db_username = "123";//帳號
	$db_password = "123";//密碼
	//設定資料連線
	if (!@mysql_connect($db_host, $db_username, $db_password)) die("資料連結失敗！");
	//連接資料庫
	if (!@mysql_select_db($db_table)) die("資料庫選擇失敗！");
	//設定字元集與連線校對
	mysql_query("SET NAMES 'utf8'");
	//設定時區
	date_default_timezone_set('Asia/Taipei');
	//警報服務標準
	$sql_query_SAS = "SELECT * FROM `SAS` WHERE `username`='".$_GET["username"]."' ";
	$result_SAS = mysql_query($sql_query_SAS);
	$row_result_SAS=mysql_fetch_assoc($result_SAS);
	//本機資訊
	$sql_query_myself = "SELECT * FROM `option` WHERE `username`='".$_GET["username"]."' AND `password`='".$_GET["password"]."'";
	$result_myself = mysql_query($sql_query_myself);
	$row_result_myself=mysql_fetch_assoc($result_myself);
	//地圖範圍
	$top=$row_result_myself["latitude"]+0.0045;
	$btm=$row_result_myself["latitude"]-0.0045;
	$right=$row_result_myself["longitude"]+0.006;
	$left=$row_result_myself["longitude"]-0.006;
	//隱藏提示
	error_reporting(0);
?>
