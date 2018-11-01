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
	//設定時區
	date_default_timezone_set('Asia/Taipei');
	if(isset($_POST["add"]) && $_POST["add"]=="修改")
	{
		$date=date("Y-m-d");
		$time=date("H:i:s");
		$sql_query_add = "INSERT INTO `data` 
		(`temperature`,`humidity`,`speed`,`date`,`time`) VALUES (";
		$sql_query_add .= "'".$_POST["temperature"]."',";
		$sql_query_add .= "'".$_POST["humidity"]."',";
		$sql_query_add .= "'".$_POST["speed"]."',";
		$sql_query_add .= "'".$date."',";
		$sql_query_add .= "'".$time."')";
		mysql_query($sql_query_add);
		//
		$sql_query_update = "UPDATE `option` SET ";
		$sql_query_update .= "`temperature`  ='".$_POST["temperature"]."',";
		$sql_query_update .= "`humidity` ='".$_POST["humidity"]."',";
		$sql_query_update .= "`speed` ='".$_POST["speed"]."' ";
		$sql_query_update .= "WHERE `username`='41072b0d7b72cfcb'";	
		mysql_query($sql_query_update);
	}
	if(isset($_POST["delete"]))
	{
		$sql_query_DELETE = "DELETE FROM `data` WHERE `id`=".$_POST["delete"];
		mysql_query($sql_query_DELETE);
	}
	$sql_query_select = "SELECT * FROM `option` WHERE `username` = '41072b0d7b72cfcb'";
	$result_select = mysql_query($sql_query_select);
	$row_result_select=mysql_fetch_assoc($result_select);
	echo "本機溫度  ".$row_result_select["temperature"]."<br>";
	echo "本機濕度  ".$row_result_select["humidity"]."<br>";
	echo "本機濕度  ".$row_result_select["speed"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改資料</title>
</head>

<body>
<form action="" method="post" id="form" name="form">
	溫度
	<input type='text' name='temperature' id='temperature' value='<?php echo $row_result_select["temperature"]?>' style='width:100px;'><br><br>
	濕度
	<input type='text' name='humidity' id='humidity' value='<?php echo $row_result_select["humidity"]?>' style='width:100px;'><br><br>
    速度
	<input type='text' name='speed' id='speed' value='<?php echo $row_result_select["speed"]?>' style='width:100px;'><br><br>
	<input type='submit' name='add' id='add' value='修改' >
</form>
<table border="1">
<form action="" method="post" id="form2" name="form2">
<?php
	$i=0;
	$sql_query_select2 = "SELECT * FROM `data` ORDER BY `date` DESC, `time` DESC";
	$result_select2 = mysql_query($sql_query_select2);
	while($row_result_select2=mysql_fetch_assoc($result_select2))
	{
		echo "<tr>";
			if($i==0)
			{
				echo "<td bgcolor='#CCFFFF'>".$row_result_select2["date"]."</td>";
				echo "<td bgcolor='#CCFFFF'>".$row_result_select2["time"]."</td>";
				echo "<td bgcolor='#CCFFFF'>".$row_result_select2["longitude"]."</td>";
				echo "<td bgcolor='#CCFFFF'>".$row_result_select2["latitude"]."</td>";
				echo "<td bgcolor='#CCFFFF'>".$row_result_select2["temperature"]."</td>";
				echo "<td bgcolor='#CCFFFF'>".$row_result_select2["humidity"]."</td>";
				echo "<td bgcolor='#CCFFFF'>".$row_result_select2["speed"]."</td>";
				echo "<td bgcolor='#CCFFFF'><input type='submit' name='delete' id='delete' value='".$row_result_select2["id"]."' ></td>";
			}
			else
			{
				echo "<td>".$row_result_select2["date"]."</td>";
				echo "<td>".$row_result_select2["time"]."</td>";
				echo "<td>".$row_result_select2["longitude"]."</td>";
				echo "<td>".$row_result_select2["latitude"]."</td>";
				echo "<td>".$row_result_select2["temperature"]."</td>";
				echo "<td>".$row_result_select2["humidity"]."</td>";
				echo "<td>".$row_result_select2["speed"]."</td>";
				echo "<td><input type='submit' name='delete' id='delete' value='".$row_result_select2["id"]."' ></td>";
			}
		echo "</tr>";
		$i++;
	}
?>
</form>
</table>
</body>
</html>