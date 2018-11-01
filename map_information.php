<?php 
	include("connMysql.php");
	//
	$date=date("Y-m-d");//今天日期
	$time=date("H:i:s");//目前時間
	/*//新增本機資訊之歷史紀錄
	$sql_query_add = "INSERT INTO `data` (`date`,`time`,`longitude`,`latitude`,`temperature`,`humidity`,`speed`,`username`,`password`) 
	VALUES (";
	$sql_query_add .= "'".$date."',";
	$sql_query_add .= "'".$time."',";
	$sql_query_add .= "'".$row_result_myself["longitude"]."',";
	$sql_query_add .= "'".$row_result_myself["latitude"]."',";
	$sql_query_add .= "'".$row_result_myself["temperature"]."',";
	$sql_query_add .= "'".$row_result_myself["humidity"]."',";
	$sql_query_add .= "'".$row_result_myself["speed"]."',";
	$sql_query_add .= "'".$_GET["username"]."',";
	$sql_query_add .= "'".$_GET["password"]."')";
	mysql_query($sql_query_add);*/
	//更換篩選條件
	if(isset($_GET["button"]))
	{
		$sql_query_SAS = "UPDATE `SAS` SET ";
		if($_GET["button"]=="取消篩選")
		{
			$sql_query_SAS .= "`type`='all' ";
		}
		else
		{
			$sql_query_SAS .= "`type`='".$_GET["button"]."' ";
		}
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
<title>本機資訊</title>
<!--利用CSS將畫面等比例縮放-->
<style>
	body,input { font-size: 9pt; }
	html { height: 100% }  
	body { height: 100%; margin: 0px; padding: 0px }  
	#map_canvas { height: 100% }        
</style>
</head>
<body bgcolor="#091e25">
<div align="center">
<!--本機即時資訊-->
<table width="600" border="0">
	<tr>
    	<td align="center" width="200" bgcolor="#0c2e3a"><font color="#FFFFFF">目前位置(經度,緯度,地址)</font></td>
        <td align="center" width="100" bgcolor="#0c2e3a"><font color="#FFFFFF">目前溫度</font></td>
        <td align="center" width="100" bgcolor="#0c2e3a"><font color="#FFFFFF">目前濕度</font></td>
        <td align="center" width="100" bgcolor="#0c2e3a"><font color="#FFFFFF">目前速度</font></td>
        <td align="center" width="100" bgcolor="#0c2e3a"><font color="#FFFFFF">目前狀況</font></td>
    </tr>	
	<tr>
		<td align="center" width="200" bgcolor="#165970">
        	<font color="#FFFFFF">
			<?php echo number_format($row_result_myself["longitude"],3)."  ,  ".number_format($row_result_myself["latitude"],3)."<br>"
			.$row_result_myself["address"];?>
            </font>
        </td>
		<td align="center" width="100" bgcolor="#165970">
			<?php 
				//如果本機溫度超過標準,呈現紅字
				if($row_result_myself["temperature"]>=$row_result_SAS["temperature"])
				{
					echo "<font color='#FF0000'>".$row_result_myself["temperature"]."</font>";
				}
				else
				{
					echo "<font color='#FFFFFF'>".$row_result_myself["temperature"]."</font>";
				}
				//echo " (".$row_result_myself["weather"].")";
			?>
        </td>
		<td align="center" width="100" bgcolor="#165970">
			<?php
				//如果本機濕度超過標準,呈現紅字
				if($row_result_myself["humidity"]>=$row_result_SAS["humidity"])
				{
					echo "<font color='#FF0000'>".$row_result_myself["humidity"]."</font>";
				}
				else
				{
					echo "<font color='#FFFFFF'>".$row_result_myself["humidity"]."</font>";
				}
			?>
        </td>
        <td align="center" width="100" bgcolor="#165970">
			<?php
				//如果本機速度超過標準,呈現紅字
				if($row_result_myself["speed"]>=$row_result_SAS["speed"])
				{
					echo "<font color='#FF0000'>".$row_result_myself["speed"]."</font>";
				}
				else
				{
					echo "<font color='#FFFFFF'>".$row_result_myself["speed"]."</font>";
				}
			?>
        </td>
		<td align="center" width="100" bgcolor="#165970">
			<?php
				//如果本機有任何一項項目超過標準,出現警告訊息
				if($row_result_myself["temperature"]>=$row_result_SAS["temperature"] || 
					$row_result_myself["humidity"]>=$row_result_SAS["humidity"] || 
					$row_result_myself["speed"]>=$row_result_SAS["speed"])
				{
					$a="<font color='#FF0000'>";
					if($row_result_myself["temperature"]>=$row_result_SAS["temperature"]){$a.="溫度超標!! <br>";}
					if($row_result_myself["humidity"]>=$row_result_SAS["humidity"]){$a.="濕度超標!! <br>";}
					if($row_result_myself["speed"]>=$row_result_SAS["speed"]){$a.="速度超標!! <br>";}
					$a.="</font>";
					echo $a;
				}
				else
				{
					echo "<font color='#37FF39'>良好!!</font>";
				}
			?>
        </td>
	</tr>
</table>
<?php
//查詢地圖範圍內有多少標點
$sql_query2 = "SELECT * FROM `option` WHERE `longitude` < '".$right."' AND `longitude` > '".$left."' AND `latitude` < '".$top."' AND `latitude` > '".$btm."'";
	if($row_result_SAS["type"]!="all")
	{
		$sql_query2 .= " AND `type` = '".$row_result_SAS["type"]."'";
	}
$result2 = mysql_query($sql_query2);
$count2 = mysql_num_rows($result2);
?>
<form action='' method='get' name='form1' id='form1'>
<table width="600" border="0">
  <tr>
    <td align="center" bgcolor="#0c2e3a">
    	<font color="#FFFFFF">目前天氣</font>
    </td>
    <td align="center" bgcolor="#0c2e3a">
    	<font color="#FFFFFF">地圖內的標點數</font>
    </td>
    <td align="center" bgcolor="#0c2e3a">
    	<?php 
			echo "
                <input type='hidden' name='username' id='username' value='".$_GET["username"]."'>
                <input type='hidden' name='password' id='password' value='".$_GET["password"]."'>
            ";
			echo "<font size='+1' color='#FFFFFF'>";
			if($row_result_SAS["type"]=="all")
			{
				echo "可以按下方圖片進行篩選";
			}
			else if ($row_result_SAS["type"]=="a")
			{
				echo "目前篩選條件為：　本機設備";
			}
			else if ($row_result_SAS["type"]=="wsn_2")
			{
				echo "目前篩選條件為：　WSN";
			}
			else if ($row_result_SAS["type"]=="6LoWPAN_2")
			{
				echo "目前篩選條件為：　6LoWPAN";
			}
			else if ($row_result_SAS["type"]=="can_bus_2")
			{
				echo "目前篩選條件為：　OBD-II";
			}
			echo "</font>";
        ?>
        <input type='image' name='button' id='button' value="取消篩選"  src="http://140.127.22.147/map/png/button.png">
    </td>
  </tr>
  <tr>
    <td align="center" bgcolor="#165970"><img src="http://140.127.22.147/map/png/sun.png"></td>
    <td align="center" bgcolor="#165970">
    	<font color="#FF0000" size="+2">
			<?php 
					echo $count2;
			?>
    	</font>
    </td>
    <td align="center" bgcolor="#165970">
    	<input type='image' name='button' id='button' value="a" 
			src="http://140.127.22.147/map/png/mobile_2.png"><font color="#FFFFFF">本機設備</font>
		<input type='image' name='button' id='button' value="wsn_2" 
			src="http://140.127.22.147/map/png/wsn_3.png"><font color="#FFFFFF">WSN</font>
		<input type='image' name='button' id='button' value="6LoWPAN_2" 
			src="http://140.127.22.147/map/png/6LoWPAN_3.png"><font color="#FFFFFF">6LoWPAN</font>
		<input type='image' name='button' id='button' value="can_bus_2" 
			src="http://140.127.22.147/map/png/can_bus_2.png"><font color="#FFFFFF">OBD-II</font>
    </td>
  </tr>
</table>
</form>
</div>
</body>
</html>