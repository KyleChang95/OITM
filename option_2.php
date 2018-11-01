<?php 
	//include("connMysql.php");
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
	error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>感測器規劃服務</title>
</head>

<body bgcolor="#165970">
<div align="center">
<?php
if(!isset($_GET["button12"]) || $_GET["button_green"]=="詳細紀錄" || $_GET["button_red"]=="詳細紀錄" || $_GET["button12"]=="載入"){
				echo  "<font color='#FFFFFF'><h4>感測器規劃服務</h4></font>
				<h5><font color='#FF0000'>請選擇欲查詢來源(預設為全選)</font></h5>
					<form action='' method='get' name='form4' id='form4'>";
						//使用者勾選項目,預設全選
						echo "<input type='checkbox' name='WSN' id='WSN'"; 
						if($_GET["t"]=="t" || $_GET["WSN"]=="on" || 
							$_GET["button_green"]=="詳細紀錄" || $_GET["button_red"]=="詳細紀錄")
						{echo "CHECKED";} echo "><font color='#FFFFFF'>WSN</font>";
						//
						echo "<input type='checkbox' name='6LoWPAN_Sensor' id='6LoWPAN_Sensor'"; 
						if($_GET["t"]=="t" || $_GET["6LoWPAN_Sensor"]=="on" ||
							$_GET["button_green"]=="詳細紀錄" || $_GET["button_red"]=="詳細紀錄")
						{echo "CHECKED";} echo "><font color='#FFFFFF'>6LoWPAN Sensor</font>";
						//
						echo "<input type='checkbox' name='CAN-BUS' id='CAN-BUS'"; 
						if($_GET["t"]=="t" || $_GET["CAN-BUS"]=="on" ||
							$_GET["button_green"]=="詳細紀錄" || $_GET["button_red"]=="詳細紀錄")
						{echo "CHECKED";} echo "><font color='#FFFFFF'>OBD-II</font> ";
						//
						echo "<input type='image' name='button12' id='button12' value='載入' src='http://140.127.22.147/map/png/button12.png'>
						<input type='hidden' name='username' id='username' value='".$_GET["username"]."'>
		  				<input type='hidden' name='password' id='password' value='".$_GET["password"]."'>
					</form>";
				//
				$sql_query2 = "SELECT * FROM `option` Where ";
				$sql_query2 .="`longitude` < '".$right."' AND `longitude` > '".$left."' AND `latitude` < '".$top."' AND `latitude` > '".$btm."'";
				if($row_result_SAS["type"]!="all")
				{
					$sql_query2 .= " AND `type` = '".$row_result_SAS["type"]."'";
				}
				$result2 = mysql_query($sql_query2);
				$count2 = mysql_num_rows($result2);
				echo  "<font size='+2' color='#FFFFFF'>左邊畫面範圍內共有 <font color='#FF0000' size='+3'>";
				echo $count2;
				echo "</font> 個標點</font><br>";
				$red=0;
				$green=0;
				while($row_result2=mysql_fetch_assoc($result2))
				{
					//檢查標點狀況
					if ($row_result2["temperature"]>=$row_result_SAS["temperature"] || $row_result2["humidity"]>=$row_result_SAS["humidity"] 
					|| $row_result2["speed"]>=$row_result_SAS["speed"])
					{
						//異常數量
						$red = $red+1;
					}
					else
					{
						//正常數量
						$green = $green+1;
					}
				}
				echo "
					<form action='' method='get' name='form2' id='form2'>
					<img src='http://maps.google.com/mapfiles/ms/icons/green-dot.png'>
					<font color='#FFFFFF'>裝置正常數量<font color='#FF0000' size='+3'>".$green."</font>個</font>
					<input type='image' name='button_green' id='button_green' value='詳細紀錄' src='http://140.127.22.147/map/png/button_green.png'>
					<br>
           			<img src='http://maps.google.com/mapfiles/ms/icons/red-dot.png'>
					<font color='#FFFFFF'>裝置異常數量<font color='#FF0000' size='+3'>".$red."</font>個</font>
					<input type='image' name='button_red' id='button_red' value='詳細紀錄' src='http://140.127.22.147/map/png/button_green.png'>
					<input type='hidden' name='username' id='username' value='".$_GET["username"]."'>
		  			<input type='hidden' name='password' id='password' value='".$_GET["password"]."'>
					</form>
				";
				echo "
					<table border='0' align='center'>
						<tr>
							<th width='70'><font color='#FFFFFF'>狀況</font></th>
							<th width='70'><font color='#FFFFFF'>經度</font></th>
							<th width='70'><font color='#FFFFFF'>緯度</font></th>
							<th width='70'><font color='#FFFFFF'>溫度</font></th>
							<th width='70'><font color='#FFFFFF'>濕度</font></th>
							<th width='80'><font color='#FFFFFF'>速度</font></th>
							<th width='130'><font color='#FFFFFF'>設備編號</font></th>
  						</tr>
					</table>
				";
				echo "<div style='height:200px;overflow:auto;'>";
				echo "<table border='1' align='center'>";
				//按下正常數量的詳細記錄
				if($_GET["button_green"]=="詳細紀錄"){
					$sql_query_green = "SELECT * FROM `option` Where ";
					$sql_query_green .= "`longitude` < '".$right."' AND `longitude` > '".$left."' ";
					$sql_query_green .= "AND `latitude` < '".$top."' AND `latitude` > '".$btm."' ";
					$sql_query_green .= "AND `temperature` < '".$row_result_SAS["temperature"]."' ";
					$sql_query_green .= "AND `humidity` < '".$row_result_SAS["humidity"]."' ";
					$sql_query_green .= "AND `speed` < '".$row_result_SAS["speed"]."'";
					if($row_result_SAS["type"]!="all")
					{
						$sql_query_green .= " AND `type` = '".$row_result_SAS["type"]."'";
					}
					$result_green = mysql_query($sql_query_green);
					
						while($row_result_green=mysql_fetch_assoc($result_green))
						{
							echo "
								<tr>
									<td width='70' align='center'>正常</td>
									<td width='70' align='center'>".number_format($row_result_green["longitude"],3)."</td>
									<td width='70' align='center'>".number_format($row_result_green["latitude"],3)."</td>
									<td width='70' align='center'>".$row_result_green["temperature"]."</td>
									<td width='70' align='center'>".$row_result_green["humidity"]."</td>
									<td width='70' align='center'>".$row_result_green["speed"]."</td>
									<td width='130' align='center'>".$row_result_green["username"]."</td>
								</tr>
							";
						}
					
				}
				//按下異常數量的詳細記
				if($_GET["button_red"]=="詳細紀錄"){
					$sql_query_red = "SELECT * FROM `option` Where ";
					$sql_query_red .= "`longitude` < '".$right."' AND `longitude` > '".$left."' ";
					$sql_query_red .= "AND `latitude` < '".$top."' AND `latitude` > '".$btm."'";
					if($row_result_SAS["type"]!="all")
					{
						$sql_query_red .= " AND `type` = '".$row_result_SAS["type"]."'";
					}
					$result_red = mysql_query($sql_query_red);
					
						while($row_result_red=mysql_fetch_assoc($result_red))
						{
							if($row_result_red["temperature"] >= $row_result_SAS["temperature"] || 
								$row_result_red["humidity"] >= $row_result_SAS["humidity"] || 
								$row_result_red["speed"] >= $row_result_SAS["speed"])
							{
								echo "
									<tr>
										<td width='70' align='center'>異常</td>
										<td width='70' align='center'>".number_format($row_result_red["longitude"],3)."</td>
										<td width='70' align='center'>".number_format($row_result_red["latitude"],3)."</td>
								";
								//若溫度超標,顯示紅字
								if($row_result_red["temperature"] >= $row_result_SAS["temperature"])
								{
									echo "<td width='70' align='center'><font color='#FF0000'>".$row_result_red["temperature"]."</font></td>";
								}
								else
								{
									echo "<td width='70' align='center'>".$row_result_red["temperature"]."</td>";
								}
								//若濕度超標,顯示紅字
								if($row_result_red["humidity"] >= $row_result_SAS["humidity"])
								{
									echo "<td width='70' align='center'><font color='#FF0000'>".$row_result_red["humidity"]."</font></td>";
								}
								else
								{
									echo "<td width='70' align='center'>".$row_result_red["humidity"]."</td>";
								}
								//若速度超標,顯示紅字
								if($row_result_red["speed"] >= $row_result_SAS["speed"])
								{
									echo "<td width='70' align='center'><font color='#FF0000'>".$row_result_red["speed"]."</font></td>";
								}
								else
								{
									echo "<td width='70' align='center'>".$row_result_red["speed"]."</td>";
								}
										echo "<td width='130' align='center'>".$row_result_red["username"]."</td>";	
								echo "</tr>";
							}
						}
					
				}
				echo "</table>";
				echo "</div>";
			}
?>
</div>
</body>
</html>