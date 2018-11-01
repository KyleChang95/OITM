<?php
	/*//資料庫主機設定
	$db_host = "localhost";//主機名稱
	$db_table = "map";//資料庫
	$db_username = "123";//帳號
	$db_password = "123";//密碼
	//設定資料連線
	if (!@mysql_connect($db_host, $db_username, $db_password)) die("資料連結失敗！");
	//連接資料庫
	if (!@mysql_select_db($db_table)) die("資料庫選擇失敗！");
	//設定字元集與連線校對
	mysql_query("SET NAMES 'utf8'");
	//更新其相對應帳密的設備經緯度
	$sql_query = "UPDATE `option` SET ";
	$sql_query .= "`longitude` ='".$_GET["longitude"]."',";
	$sql_query .= "`latitude`  ='".$_GET["latitude"]."',";
	$sql_query .= "`address` ='".$_GET["address"]."'  ";
	$sql_query .= "WHERE `username`='".$_GET["username"]."' AND `password`='".$_GET["password"]."' ";	
	mysql_query($sql_query);*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>本機資訊</title>
</head>
<body bgcolor="#091e25">
</body>
</html>