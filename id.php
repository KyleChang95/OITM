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
//查詢資料庫
$selectSQL = "SELECT * FROM `option` WHERE `username`='".$_POST['username']."' ";
$rs = mysql_query($selectSQL, $dblink) or die(mysql_error());
$count=mysql_num_rows($rs);
//如果查無資料,則新增
if($count==0){
	$sql_query_add = "INSERT INTO `option` (`longitude`,`latitude`,`temperature`,`humidity`,`speed`,`username`,`password`) 
	VALUES (";
	$sql_query_add .= "'120.611897',";
	$sql_query_add .= "'22.646857',";
	$sql_query_add .= "'25',";
	$sql_query_add .= "'25',";
	$sql_query_add .= "'25',";
	$sql_query_add .= "'".$_POST["username"]."',";
	$sql_query_add .= "'".$_POST["password"]."')";
	mysql_query($sql_query_add);
	//
	$sql_query_add2 = "INSERT INTO `sas` (`username`) VALUES (";
	$sql_query_add2 .= "'".$_POST["username"]."')";
	mysql_query($sql_query_add2);
}
?>