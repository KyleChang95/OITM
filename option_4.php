<?php 
	include("connMysql.php");
	if($_GET["button6"]=="載入" && isset($_GET["button6"]))
	{
		$sql_query_SAS = "UPDATE `SAS` SET ";
		$sql_query_SAS .= "`temperature`='".$_GET["temperature_SAS"]."',";
		$sql_query_SAS .= "`humidity`='".$_GET["humidity_SAS"]."',";
		$sql_query_SAS .= "`speed`='".$_GET["speed_SAS"]."' ";
		$sql_query_SAS .= "WHERE `username`='".$_GET["username"]."' ";	
		mysql_query($sql_query_SAS);
		//警報服務標準
		$sql_query_SAS = "SELECT * FROM `SAS` WHERE `username`='".$_GET["username"]."' ";
		$result_SAS = mysql_query($sql_query_SAS);
		$row_result_SAS=mysql_fetch_assoc($result_SAS);
	}
	if($_GET["button8"]=="重設" && isset($_GET["button8"]))
	{
		$sql_query_SAS = "UPDATE `SAS` SET ";
		$sql_query_SAS .= "`temperature`=40 ,";
		$sql_query_SAS .= "`humidity`=40 ,";
		$sql_query_SAS .= "`speed`=60 ";
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
<title>感測器警報服務</title>
</head>

<body bgcolor="#165970">
<div align="center">
<?php
//感測器警報服務
			if(!isset($_GET["button6"]) || $_GET["button6"]=="載入" || $_GET["button8"]=="重設"){
				echo  "<font color='#FFFFFF'><h4>感測器警報服務</h4></font>
				<h5><font color='#FF0000'>請輸入警告標準(預設標準為:溫度40;濕度40;速度40)</font></h5>
				<form action='' method='get' name='form4' id='form4'>
					<font color='#FFFFFF'>溫度：<input type='text' name='temperature_SAS' id='temperature_SAS' value='".$row_result_SAS["temperature"]."' style='width:100px'>
					濕度：<input type='text' name='humidity_SAS' id='humidity_SAS' value='".$row_result_SAS["humidity"]."' style='width:100px'>
					速度：<input type='text' name='speed_SAS' id='speed_SAS' value='".$row_result_SAS["speed"]."' style='width:100px'>
					</font>
					<br>
					<input type='image' name='button6' id='button6' value='載入' src='http://140.127.22.147/map/png/button12.png'>
					<input type='image' name='button8' id='button8' value='重設' src='http://140.127.22.147/map/png/button8.png'>
					<input type='hidden' name='username' id='username' value='".$_GET["username"]."'>
		  			<input type='hidden' name='password' id='password' value='".$_GET["password"]."'>
				</form>
				";
				//當按下載入
				if($_GET["button6"]=="載入")
				{
					$sql_query4 ="SELECT * FROM `option` WHERE ";
					$sql_query4 .="`longitude` < '".$right."' AND `longitude` > '".$left."' ";
					$sql_query4 .="AND `latitude` < '".$top."' AND `latitude` > '".$btm."' AND ";
					//收到溫度標準
					if($_GET["temperature_SAS"]!="")
					{
						$sql_query4 .="`temperature` >= '".$_GET["temperature_SAS"]."'";
					}
					//收到濕度標準
					if($_GET["humidity_SAS"]!="")
					{
						//當溫度和濕度都收到時,SQL語法加入OR
						if($_GET["temperature_SAS"]!="")
						{
							$sql_query4 .=" OR ";
						}
						$sql_query4 .="`humidity` >='".$_GET["humidity_SAS"]."'";
					}
					//收到速度標準
					if($_GET["speed_SAS"]!="")
					{
						//當三項標準都收到時,SQL語法加入OR
						if($_GET["temperature_SAS"]!="" || $_GET["humidity_SAS"]!="")
						{
							$sql_query4 .=" OR ";
						}
						$sql_query4 .="`speed` >='".$_GET["speed_SAS"]."'";
					}
				}
				//未收到任何標準,以預設標準進行檢查
				else
				{
					$sql_query4 = "SELECT * FROM `option` WHERE `temperature` >= '".$row_result_SAS["temperature"]."' 
						OR `humidity` >= '".$row_result_SAS["humidity"]."' OR `speed` >= '".$row_result_SAS["speed"]."'  AND ";
					$sql_query4 .="`longitude` < '".$right."' AND `longitude` > '".$left."' ";
					$sql_query4 .="AND `latitude` < '".$top."' AND `latitude` > '".$btm."' ";
				}
				$result4 = mysql_query($sql_query4);
				$count = mysql_num_rows($result4);
				//$count >0表示有感測器發生問題
				if($count >0)
				{
					$toast = "<font color='#FF0000' size='+3'>警告!!</font>";
				}
				else
				{
					echo "<font color='#37FF39' size='+3'>一切良好!!</font>";
				}
				$result42 = mysql_query($sql_query4);
				while($row_result42=mysql_fetch_assoc($result42))
				{
					//三項標準個別進行檢查
					if($row_result42["temperature"]>=$row_result_SAS["temperature"])
					{
						$i++;
					}
					//
					if($row_result42["humidity"]>=$row_result_SAS["humidity"])
					{
						$j++;
					}
					//
					if($row_result42["speed"]>=$row_result_SAS["speed"])
					{
						$k++;
					}
				}
				if($i>0){$toast .= "<font color='#FF0000' size='+3'> 溫度超標!!</font>";}
				if($j>0){$toast .= "<font color='#FF0000' size='+3'> 濕度超標!!</font>";}
				if($k>0){$toast .= "<font color='#FF0000' size='+3'> 速度超標!!</font>";}
				//呈現訊息
				echo $toast;
				echo "
					<table border='0' align='center'>
						<tr>
							<th width='70'><font color='#FFFFFF'>經度</font></th>
							<th width='70'><font color='#FFFFFF'>緯度</font></th>
							<th width='70'><font color='#FFFFFF'>溫度</font></th>
							<th width='70'><font color='#FFFFFF'>濕度</font></th>
							<th width='80'><font color='#FFFFFF'>速度</font></th>
							<th width='130'><font color='#FFFFFF'>設備編號</font></th>
  						</tr>
					</table>
					<div style='height:250px;overflow:auto;'>
					<table border='1' align='center'>";
					while($row_result4=mysql_fetch_assoc($result4))
					{
							echo "
							<tr>
								<td width='70' align='center'>".number_format($row_result4["longitude"],3)."</td>
								<td width='70' align='center'>".number_format($row_result4["latitude"],3)."</td>
							";
							//溫度超標呈現紅字
							if($row_result4["temperature"]>=$row_result_SAS["temperature"])
							{
								echo "<td width='70' align='center'><font color='#FF0000'>".$row_result4["temperature"]."</font></td>";
							}
							else
							{
								echo "<td width='70' align='center'>".$row_result4["temperature"]."</td>";
							}
							//濕度超標呈現紅字
							if($row_result4["humidity"]>=$row_result_SAS["humidity"])
							{
								echo "<td width='70' align='center'><font color='#FF0000'>".$row_result4["humidity"]."</font></td>";
							}
							else
							{
								echo "<td width='70' align='center'>".$row_result4["humidity"]."</td>";
							}
							//速度超標呈現紅字
							if($row_result4["speed"]>=$row_result_SAS["speed"])
							{
								echo "<td width='70' align='center'><font color='#FF0000'>".$row_result4["speed"]."</font></td>";
							}
							else
							{
								echo "<td width='70' align='center'>".$row_result4["speed"]."</td>";
							}
								echo "<td width='130' align='center'>".$row_result4["username"]."</td>";
					}
				echo "</tr></table></div>";
			}
?>
</div>
</body>
</html>