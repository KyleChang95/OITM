<?php
	include("connMysql.php");
	//更新標點的視窗訊息
	$sql_query_information = "SELECT * FROM `option` ";
	$result_information = mysql_query($sql_query_information);
	while($row_result_information=mysql_fetch_assoc($result_information))
	{
		if($row_result_information["icon"]!="http://140.127.1.105/map/png/can_bus_2.png")
		{
			$sql_query_update = "UPDATE `option` SET ";
			$sql_query_update .= "`content`='經度：".$row_result_information["longitude"]."<br>緯度：".$row_result_information["latitude"]."";
			$sql_query_update .= "<br>溫度：".$row_result_information["temperature"]." (°C)<br>濕度：".$row_result_information["humidity"]." (g/m^3)";
			$sql_query_update .= "<br>速度：".$row_result_information["speed"]." (km/hr)<br>設備編號：".$row_result_information["username"]."";
			$sql_query_update .= "<br>天氣：".$row_result_information["weather"]." ' ";
			$sql_query_update .= "WHERE `username`='".$row_result_information["username"]."' ";
			$sql_query_update .= "AND `password`='".$row_result_information["password"]."' ";
			mysql_query($sql_query_update);
		}
		else
		{
			$sql_query_update = "UPDATE `option` SET ";
			$sql_query_update .= "`content`='";
			$sql_query_update .= "三軸感測器(一)<br>";
			$sql_query_update .= "x:g-2.5 2.5<br>";
			$sql_query_update .= "y:g-2.5 2.5<br>";
			$sql_query_update .= "z:g-2.5 2.5<br>";
			$sql_query_update .= "三軸感測器(二)<br>";
			$sql_query_update .= "x:g-2.5 2.5<br>";
			$sql_query_update .= "y:g-2.5 2.5<br>";
			$sql_query_update .= "z:g-2.5 2.5<br>";
			$sql_query_update .= "時速：85　(km/hr)<br>";
			$sql_query_update .= "轉速：70　(rpm)<br>";
			$sql_query_update .= "空氣流量：90　(grams/sec)<br>";
			$sql_query_update .= "引擎冷卻溫度：85　(°C)<br>";
			$sql_query_update .= "'";
			$sql_query_update .= "WHERE `username`='".$row_result_information["username"]."' ";
			$sql_query_update .= "AND `password`='".$row_result_information["password"]."' ";
			mysql_query($sql_query_update);
		}
		 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>標題</title>
<style>
	body,input { font-size: 9pt; }
	html { height: 100% }  
	body { height: 100%; margin: 0px; padding: 0px }  
	#map_canvas { height: 100% }        
</style>
</head>

<body bgcolor="#091e25">
<div align="center">
<img src="http://140.127.22.147/map/png/top3.png">
</div>
</body>
</html>