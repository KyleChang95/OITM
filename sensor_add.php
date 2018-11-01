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
	header("Content-Type: text/html; charset=utf-8");
	if(isset($_POST["add"]) && $_POST["add"]=="註冊")
	{
		$rand_1=rand(20,35);
		$rand_2=rand(20,35);
		$rand_3=rand(20,35);
		$today=date("Y-m-d");
		$sql_query_add = "INSERT INTO `option` 
		(`longitude`,`latitude`,`temperature`,`humidity`,`speed`,`icon`,`date`,`username`,`password`) VALUES (";
		$sql_query_add .= "'".$_POST["longitude"]."',";
		$sql_query_add .= "'".$_POST["latitude"]."',";
		$sql_query_add .= "'".$rand_1."',";
		$sql_query_add .= "'".$rand_2."',";
		$sql_query_add .= "'".$rand_3."',";
		$sql_query_add .= "'http://140.127.1.105/map/png/can_bus_2.png',";
		$sql_query_add .= "'".$today."',";
		$sql_query_add .= "'".$_POST["username"]."',";
		$sql_query_add .= "'".$_POST["username"]."')";
		mysql_query($sql_query_add);
	}
	if(isset($_POST["update"]))
	{
		$sql_query = "UPDATE `option` SET ";
		$sql_query .= "`longitude` ='".$_POST["longitude_".$_POST["update"].""]."',";
		$sql_query .= "`latitude`  ='".$_POST["latitude_".$_POST["update"].""]."',";
		$sql_query .= "`content`  ='".$_POST["content_".$_POST["update"].""]."',";
		$sql_query .= "`icon` ='".$_POST["icon_".$_POST["update"].""]."'  ";
		$sql_query .= "WHERE `username`='".$_POST["update"]."'";	
		mysql_query($sql_query);
	}
	$sql_query_select = "SELECT * FROM `option` WHERE `type` != '' ORDER BY `longitude` ASC";
	$result_select = mysql_query($sql_query_select);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>感測器管理</title>
</head>

<body>
<div align="center">
<table border="0" width="1024">
  <tr>
    <td>
			<form action='' method='post' name='form1' id='form1'>
                感測器編號
                <input type='text' name='username' id='username' value='' style='width:100px;'><br><br>
                經度
                <input type='text' name='longitude' id='longitude' value='' style='width:100px;'><br><br>
                緯度
                <input type='text' name='latitude' id='latitude' value='' style='width:100px;'><br><br>
                <div align="center">
                	<input type='submit' name='add' id='add' value='註冊' >
                </div>
			</form> 
	</td>
    	<td align="center">
        	<table border="1" width="600">
            <form action='' method='post' name='form2' id='form2'>
    	<?php
			while($row_result_select=mysql_fetch_assoc($result_select))
			{
				echo "
					<tr>
						<td><input type='submit' name='update' id='update' value='".$row_result_select["username"]."' ></td>
						<td><input type='text' name='longitude_".$row_result_select["username"]."' 
							id='longitude_".$row_result_select["username"]."' 
							value='".$row_result_select["longitude"]."' 
							style='width:100px;'>
						</td>
						<td><input type='text' name='latitude_".$row_result_select["username"]."' 
							id='latitude' 
							value='".$row_result_select["latitude"]."' 
							style='width:100px;'>
						</td>
						<td><input type='text' name='icon_".$row_result_select["username"]."' 
							id='icon_".$row_result_select["username"]."' 
							value='".$row_result_select["icon"]."' 
							style='width:300px;'>
						</td>
						<td><input type='text' name='content_".$row_result_select["username"]."' 
							id='content_".$row_result_select["username"]."'
							value='".$row_result_select["content"]."'
							style='width:300px;'>
						</td>
					</tr>
			  	";
			}
		?>
        </form>
        </table>
    </td>
  </tr>
</table>
</div> 
</body>
</html>