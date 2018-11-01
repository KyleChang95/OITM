<?php 
	//資料庫主機設定
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
	//
	//警報服務標準
	$sql_query_SAS = "SELECT * FROM `SAS` WHERE `username`='".$_POST["username"]."' ";
	$result_SAS = mysql_query($sql_query_SAS);
	$row_result_SAS=mysql_fetch_assoc($result_SAS);
	//本機資訊
	$sql_query_myself = "SELECT * FROM `option` WHERE `username`='".$_POST["username"]."' AND `password`='".$_POST["password"]."'";
	$result_myself = mysql_query($sql_query_myself);
	$row_result_myself=mysql_fetch_assoc($result_myself);
	//地圖範圍
	$top=$row_result_myself["latitude"]+0.0045;
	$btm=$row_result_myself["latitude"]-0.0045;
	$right=$row_result_myself["longitude"]+0.006;
	$left=$row_result_myself["longitude"]-0.006;
	echo "no/";
	if($row_result_SAS["check_temperature"]=="on")
	{
		//查詢地圖範圍內所有標點"溫度"的情況,若超過標準,出現警告訊息
		$sql_query1 = "SELECT * FROM `option` WHERE `temperature` >= '".$row_result_SAS["temperature"]."' ";
		$sql_query1 .="AND  `longitude` < '".$right."' AND `longitude` > '".$left."' AND `latitude` < '".$top."' AND `latitude` > '".$btm."'";
		$result1 = mysql_query($sql_query1);
		$count1 = mysql_num_rows($result1);
		if($count1>0)
		{
			echo "temperature/";
		}
		else
		{
			echo "no/";
		}
	}
	else
	{
		echo "no/";
	}
	if($row_result_SAS["check_humidity"]=="on")
	{
		//查詢地圖範圍內所有標點"濕度"的情況,若超過標準,出現警告訊息
		$sql_query2 = "SELECT * FROM `option` WHERE `humidity` >= '".$row_result_SAS["humidity"]."' ";
		$sql_query2 .= "AND  `longitude` < '".$right."' AND `longitude` > '".$left."' AND `latitude` < '".$top."' AND `latitude` > '".$btm."'";
		$result2 = mysql_query($sql_query2);
		$count2 = mysql_num_rows($result2);
		if($count2>0)
		{
			echo "humidity/";
		}
		else
		{
			echo "no/";
		}
	}
	else
	{
		echo "no/";
	}
	if($row_result_SAS["check_speed"]=="on")
	{
		//查詢地圖範圍內所有標點"速度"的情況,若超過標準,出現警告訊息
		$sql_query3 = "SELECT * FROM `option` WHERE `speed` >= '".$row_result_SAS["speed"]."' ";
		$sql_query3 .= "AND  `longitude` < '".$right."' AND `longitude` > '".$left."' AND `latitude` < '".$top."' AND `latitude` > '".$btm."'";
		$result3 = mysql_query($sql_query3);
		$count3 = mysql_num_rows($result3);
		if($count3>0)
		{
			echo "speed/";
		}
		else
		{
			echo "no/";
		}
	}
	else
	{
		echo "no/";
	}
	echo $row_result_SAS["time"];
?>