<?php
	//��Ʈw�D���]�w
	$db_host = "localhost";//�D���W��
	$db_table = "map";//��Ʈw�W��
	$db_username = "123";//�b��
	$db_password = "123";//�K�X
	//�]�w��Ƴs�u
	if (!@mysql_connect($db_host, $db_username, $db_password)) die("��Ƴs�����ѡI");
	//�s����Ʈw
	if (!@mysql_select_db($db_table)) die("��Ʈw��ܥ��ѡI");
	//�]�w�r�����P�s�u�չ�
	mysql_query("SET NAMES 'utf8'");
//�d�߸�Ʈw
$selectSQL = "SELECT * FROM `option` WHERE `username`='".$_POST['username']."' ";
$rs = mysql_query($selectSQL, $dblink) or die(mysql_error());
$count=mysql_num_rows($rs);
//�p�G�d�L���,�h�s�W
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