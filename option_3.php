<?php 
	include("connMysql.php");
	if($_GET["button9"]=="載入")
	{
		$sql_query_SAS = "UPDATE `SAS` SET ";
		
		if($_GET["temperature2"]=="on")
		{
			$sql_query_SAS .= "`check_temperature`='on' ,";
		}
		else
		{
			$sql_query_SAS .= "`check_temperature`='aa' ,";
		}
		if($_GET["humidity2"]=="on")
		{
			$sql_query_SAS .= "`check_humidity`='on' ,";
		}
		else
		{
			$sql_query_SAS .= "`check_humidity`='aa' ,";
		}
		if($_GET["speed2"]=="on")
		{
			$sql_query_SAS .= "`check_speed`='on' ,";
		}
		else
		{
			$sql_query_SAS .= "`check_speed`='aa' ,";
		}
		$sql_query_SAS .= "`time`='".$_GET["time"]."' ";
		$sql_query_SAS .= "WHERE `username`='".$_GET["username"]."' ";	
		mysql_query($sql_query_SAS);
		//警報服務標準
		$sql_query_SAS = "SELECT * FROM `SAS` WHERE `username`='".$_GET["username"]."' ";
		$result_SAS = mysql_query($sql_query_SAS);
		$row_result_SAS=mysql_fetch_assoc($result_SAS);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>感測器通告服務</title>
</head>

<body bgcolor="#165970">
<div align="center">
<?php
//感測器通告服務
			if(!isset($_GET["button9"]) || $_GET["button9"]=="載入"){
				echo  "<font color='#FFFFFF'><h4>感測器通告服務</h4></font>
				<h5><font color='#FF0000'>請選擇欲通告項目(預設全選)或重整時間</font></h5>";
				echo "<form action='' method='get' name='form1' id='form1'>";
					//使用者勾選項目,預設全選
					echo "<input type='checkbox' name='temperature2' id='temperature2'"; 
					if($row_result_SAS["check_temperature"]=="on"){echo "CHECKED";} echo "><font color='#FFFFFF'>溫度</font>";
					echo "<input type='checkbox' name='humidity2' id='humidity2'"; 
					if($row_result_SAS["check_humidity"]=="on"){echo "CHECKED";} echo "><font color='#FFFFFF'>濕度</font>";
					echo "<input type='checkbox' name='speed2' id='speed2'"; 
					if($row_result_SAS["check_speed"]=="on"){echo "CHECKED";} echo "><font color='#FFFFFF'>速度</font>";
					echo "<br>";
					echo "<font color='#FFFFFF'>重整時間<input type='text' name='time' id='time' value='".$row_result_SAS["time"]."' style='width:50px;'>秒</font><br>";
					echo "<input type='image' name='button9' id='button9' value='載入' src='http://140.127.22.147/map/png/button12.png'>
					<input type='hidden' name='username' id='username' value='".$_GET["username"]."'>
					<input type='hidden' name='password' id='password' value='".$_GET["password"]."'>
				</form>";
			}
?>
</div>
</body>
</html>