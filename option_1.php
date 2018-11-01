<?php 
	include("connMysql.php");
	//Google Chart API
	function drawChart($chf,$cht,$chs,$chxl,$chxr,$chds,$chxs,$chco,$chdlp,$chls,$chtt,$chg,$chd) {
	$url = "http://chart.apis.google.com/chart?";
	$url .= "chf=".$chf."
			&cht=".$cht."
			&chxt=x,y
			&chs=".$chs."
			&chxl=0:".$chxl."
			&chxr=".$chxr."
			&chds=".$chds."
			&chxs=".$chxs."
			&chco=".$chco."
			&chdlp=".$chdlp."
			&chls=".$chls."
			&chtt=".$chtt."
			&chg=".$chg.";
			&chd=t:-1|".$chd."";
	print <<<END
	<img src="$url">
END;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>感測器觀察服務</title>
</head>

<body bgcolor="#165970">
<div align="center">
<?php
	//感測器觀察服務
	if(!isset($_GET["button5"]) || $_GET["button5"]=="重新整理" || $_GET["button7"]=="圖表統計" 
	|| $_GET["button10"]=="查詢" || $_GET["button11"]=="重設"){
				echo "
					<font color='#FFFFFF'><h4>感測器觀察服務</h4></font>
					<form action='' method='get' name='form1' id='form1'>";
						//使用者勾選項目,預設全選
						echo "<input type='checkbox' name='date' id='date'"; 
						if($_GET["date"]=="on" || $_GET["t"]=="t"){echo "CHECKED";} echo "><font color='#FFFFFF'>日期</font>";
						echo "<input type='checkbox' name='time' id='time'"; 
						if($_GET["time"]=="on" || $_GET["t"]=="t"){echo "CHECKED";} echo "><font color='#FFFFFF'>時間</font>";
						echo "<input type='checkbox' name='longitude' id='longitude'"; 
						if($_GET["longitude"]=="on" || $_GET["t"]=="t"){echo "CHECKED";} echo "><font color='#FFFFFF'>經度</font>";
						echo "<input type='checkbox' name='latitude' id='latitude'"; 
						if($_GET["latitude"]=="on" || $_GET["t"]=="t"){echo "CHECKED";} echo "><font color='#FFFFFF'>緯度</font>";
						echo "<input type='checkbox' name='temperature' id='temperature'"; 
						if($_GET["temperature"]=="on" || $_GET["t"]=="t"){echo "CHECKED";} echo "><font color='#FFFFFF'>溫度</font>";
						echo "<input type='checkbox' name='humidity' id='humidity'"; 
						if($_GET["humidity"]=="on" || $_GET["t"]=="t"){echo "CHECKED";} echo "><font color='#FFFFFF'>濕度</font>";
						echo "<input type='checkbox' name='speed' id='speed'"; 
						if($_GET["speed"]=="on" || $_GET["t"]=="t"){echo "CHECKED";} echo "><font color='#FFFFFF'>速度</font>";
						echo "
						<input type='image' name='button5' id='button5' value='重新整理' src='http:/140.127.22.147/map/png/button5.png'>
						<input type='image' name='button7' id='button7' value='圖表統計' src='http://140.127.22.147/map/png/button7.png'>
						<input type='hidden' name='a' id='a' value='a'>
						<input type='hidden' name='username' id='username' value='".$_GET["username"]."'>
		  				<input type='hidden' name='password' id='password' value='".$_GET["password"]."'>
					</form>
				";
				//當使用者第一次進入頁面時,所預載的感測器觀察服務之資料
				if(!isset($_GET["a"]))
				{
					$sql_query3 = "SELECT * FROM `data` WHERE `username` = '".$_GET["username"]."' AND `password` = '".$_GET["password"]."' 
					ORDER BY `date` DESC,`time` DESC LIMIT 5";
					$result3 = mysql_query($sql_query3);
					$count = mysql_num_rows($result3);
					if($count==0){echo "<h4><font color='#FF0000'>查無資料!!</font></h4>";}
					echo "
					<br><table border='0' align='center'>
					<tr>";
							echo "<td width='100' align='center'><font color='#FFFFFF'>日期</font></td>";
							echo "<td width='100' align='center'><font color='#FFFFFF'>時間</font></td>";
							echo "<td width='100' align='center'><font color='#FFFFFF'>經度</font></td>";
							echo "<td width='100' align='center'><font color='#FFFFFF'>緯度</font></td>";
							echo "<td width='100' align='center'><font color='#FFFFFF'>溫度</font></td>";
							echo "<td width='100' align='center'><font color='#FFFFFF'>濕度</font></td>";
							echo "<td width='100' align='center'><font color='#FFFFFF'>速度</font></td>";
					echo "
					</tr>
					</table>
					<table border='1' align='center'>";
					$first=0;//判斷是否第一筆
					while($row_result3=mysql_fetch_assoc($result3))
					{
						echo "<tr>";
						//若為第一筆資料,呈現不同顏色標記
						echo "<td width='95' align='center' "; if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["date"]."</td>";
						echo "<td width='90' align='center' "; if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["time"]."</td>";
						echo "<td width='90' align='center' "; if($first==0){echo "bgcolor='#66FF66'";}echo ">".number_format($row_result3["longitude"],3)."</td>";
						echo "<td width='90' align='center' "; if($first==0){echo "bgcolor='#66FF66'";}echo ">".number_format($row_result3["latitude"],3)."</td>";
						echo "<td width='100' align='center' "; if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["temperature"]."</td>";
						echo "<td width='100' align='center' "; if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["humidity"]."</td>";
						echo "<td width='100' align='center' "; if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["speed"]."</td>";
						//當已經呈現第一筆之後,更改變數,讓系統判斷是否需要更改顏色
						if($first==0){$first++;}
						echo "</tr>";
					}
					echo "</table>";
				}
				//感測器觀察服務之重新整理,可供使用者刷新資料,$_GET["a"]表示表單已經送出
				if($_GET["button5"]=="重新整理" && $_GET["a"]=="a")
				{
					$sql_query3 = "SELECT * FROM `data` WHERE `username` = '".$_GET["username"]."' AND `password` = '".$_GET["password"]."' 
					ORDER BY `date` DESC,`time` DESC LIMIT 5";
					$result3 = mysql_query($sql_query3);
					$count = mysql_num_rows($result3);
					if($count==0){echo "<h4><font color='#FF0000'>查無資料!!</font></h4>";}
					echo "
					<br><table border='0' align='center'>
					<tr>";
							//根據使用者所勾選的項目呈現資料
							if($_GET["date"]=="on"){echo "<td width='100' align='center'><font color='#FFFFFF'>日期</font></td>";}
							if($_GET["time"]=="on"){echo "<td width='100' align='center'><font color='#FFFFFF'>時間</font></td>";}
							if($_GET["longitude"]=="on"){echo "<td width='100' align='center'><font color='#FFFFFF'>經度</font></td>";}
							if($_GET["latitude"]=="on"){echo "<td width='100' align='center'><font color='#FFFFFF'>緯度</font></td>";}
							if($_GET["temperature"]=="on"){echo "<td width='100' align='center'><font color='#FFFFFF'>溫度</font></td>";}
							if($_GET["humidity"]=="on"){echo "<td width='100' align='center'><font color='#FFFFFF'>濕度</font></td>";}
							if($_GET["speed"]=="on"){echo "<td width='100' align='center'><font color='#FFFFFF'>速度</font></td>";}
					echo "
					</tr>
					</table>
					<table border='1' align='center'>";
					$first=0;//判斷是否第一筆
					while($row_result3=mysql_fetch_assoc($result3))
					{
						echo "<tr>";
							//根據使用者所勾選的項目呈現資料,以及判斷是否為第一筆
							if($_GET["date"]=="on"){echo "<td width='95' align='center' "; 
							if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["date"]."</td>";}
							if($_GET["time"]=="on"){echo "<td width='90' align='center' "; 
							if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["time"]."</td>";}
							if($_GET["longitude"]=="on"){echo "<td width='90' align='center' "; 
							if($first==0){echo "bgcolor='#66FF66'";}echo ">".number_format($row_result3["longitude"],3)."</td>";}
							if($_GET["latitude"]=="on"){echo "<td width='90' align='center' "; 
							if($first==0){echo "bgcolor='#66FF66'";}echo ">".number_format($row_result3["latitude"],3)."</td>";}
							if($_GET["temperature"]=="on"){echo "<td width='100' align='center' "; 
							if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["temperature"]."</td>";}
							if($_GET["humidity"]=="on"){echo "<td width='100' align='center' "; 
							if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["humidity"]."</td>";}
							if($_GET["speed"]=="on"){echo "<td width='100' align='center' "; 
							if($first==0){echo "bgcolor='#66FF66'";}echo ">".$row_result3["speed"]."</td>";}
							if($first==0){$first++;}
						echo "</tr>";
					}
					echo "</table>";
				}
				//感測器觀察服務之歷史紀錄,可供使用者瀏覽完整的紀錄,$_GET["a"]表示表單已經送出
				if($_GET["button7"]=="圖表統計" && $_GET["a"]=="a" || $_GET["button10"]=="查詢" || $_GET["button11"]=="重設")
				{
					if(!isset($_GET["date1"]))
					{
						$day_1 = date("Y-m-d",strtotime("-7 day"));
					}
					else
					{
						$day_1 = $_GET["date1"];
					}
					if(!isset($_GET["date2"]))
					{
						$day_2 = date("Y-m-d");
					}
					else
					{
						$day_2 = $_GET["date2"];
					}
					
					echo "<br><form action='' method='get' name='formdate' id='formdate'>
					<font color='#FFFFFF'>選擇日期範圍</font>
					<font color='#FFFFFF'>從</font>
					<input id='date1' name='date1' class='Wdate' type='text' onFocus='WdatePicker()' value='".$day_1."'/>
					<script language='javascript' type='text/javascript' src='My97DatePicker/WdatePicker.js'></script>
					<font color='#FFFFFF'>到</font>
					<input id='date2' name='date2' class='Wdate' type='text' onFocus='WdatePicker()' value='".$day_2."'/>
					<script language='javascript' type='text/javascript' src='My97DatePicker/WdatePicker.js'></script>
					";
							if($_GET["date"]=="on"){echo "<input type='hidden' name='date' id='date' value='on'>";}
							if($_GET["time"]=="on"){echo "<input type='hidden' name='time' id='time' value='on'>";}
							if($_GET["longitude"]=="on"){echo "<input type='hidden' name='longitude' id='longitude' value='on'>";}
							if($_GET["latitude"]=="on"){echo "<input type='hidden' name='latitude' id='latitude' value='on'>";}
							if($_GET["temperature"]=="on"){echo "<input type='hidden' name='temperature' id='temperature' value='on'>";}
							if($_GET["humidity"]=="on"){echo "<input type='hidden' name='humidity' id='humidity' value='on'>";}
							if($_GET["speed"]=="on"){echo "<input type='hidden' name='speed' id='speed' value='on'>";}
					echo "
						<input type='hidden' name='button7' id='button7' value='圖表統計'>
						<input type='hidden' name='a' id='a' value='a'>
						<input type='hidden' name='username' id='username' value='".$_GET["username"]."'>
		  				<input type='hidden' name='password' id='password' value='".$_GET["password"]."'>
						<br>
						<font color='#FFFFFF'>選擇欲查詢圖表類型</font>
						<select name='chart'>
					";
 					echo "<option value='temperature'"; if($_GET["chart"]=="temperature"){echo "selected";}echo "> 溫度 </option>";
 					echo "<option value='humidity'"; if($_GET["chart"]=="humidity"){echo "selected";}echo "> 濕度 </option>";
 					echo "<option value='speed'"; if($_GET["chart"]=="speed"){echo "selected";}echo "> 速度 </option>";
					echo "
						</select>
						<input type='submit' name='button10' id='button10' value='查詢'>
					";
					//
					$sql_query5 = "SELECT * FROM `data` WHERE `username` = '".$_GET["username"]."' AND `password` = '".$_GET["password"]."' ";
					$sql_query5 .= "AND `date` >= '".$day_1."' AND `date` <= '".$day_2."' ";
					$sql_query5 .= "ORDER BY `date` DESC,`time` DESC";
					$result5 = mysql_query($sql_query5);
					$result5_chart = mysql_query($sql_query5);
					$count = mysql_num_rows($result5);
					if($count==0){echo "<h4><font color='#FF0000'>查無資料!!</font></h4>";}
					$chart=$_GET["chart"];
					if($_GET["choose"]=="圖表呈現" || !isset($_GET["choose"]))
					{
						//圖表呈現
						while($row_result5_chart=mysql_fetch_assoc($result5_chart))
						{
							if($_GET["button10"]=="查詢")
							{
								$data[] = $row_result5_chart["".$chart.""];
							}
							else
							{
								$data[] = $row_result5_chart["temperature"];
							}
						}
						//變數設定
							$chf = "bg,s,E8E8E8";
							$cht = "lc";//圖表類型,lc為折線圖
							$chs = "500x200";//圖表大小,寬*長
							$chxl = "|30|29|28|27|26|25|24|23|22|21";
							$chxr = "0,0,".count($data)."|1,0,100";//y軸(1:y軸,0:x軸)
							$chds = "0,100";//y軸最小值和最大值
							$chxs = "0,EA3131,11.5,0,l,676767|1,000000,11.5,0,lt,676767";//兩邊單位的顏色
							$chco = "3072F3";//背景顏色
							$chdlp = "t";//線條名稱位置,top
							$chls = "2";//線條粗細小
							$chtt = "  ";
							$chg = "-1,-1,0,0";
							//資料內容
							for($c=0;$c<=count($data)-1;$c++)
							{
								if($c==count($data)-1)
								{
									$chd .= "".$data[$c]."";
								}else
								{
									$chd .= "".$data[$c].",";
								}
							}
							if($_GET["chart"]=="temperature" || !isset($_GET["chart"])){echo "<br><font color='#FFFFFF'>°C</font>";}
							if($_GET["chart"]=="humidity"){echo "<br><font color='#FFFFFF'>g/m^3</font>";}
							if($_GET["chart"]=="speed"){echo "<br><font color='#FFFFFF'>km/hr</font>";}
							drawChart($chf,$cht,$chs,$chxl,$chxr,$chds,$chxs,$chco,$chdlp,$chls,$chtt,$chg,$chd);
							echo "<div align='left' style='width:450px'><font color='#FFFFFF'>日期</font>
							　　　　　　　　　　　<font color='#FF0000'>2014/06</font></div>";
					}
					if($_GET["choose"]=="歷史紀錄")
					{
						echo "<table border='0' align='center'><tr>";
							//根據使用者所勾選的項目呈現資料
							if($_GET["date"]=="on"){echo "<td width='100' align='center'><font color='#FFFFFF'>日期</font></td>";}
							if($_GET["time"]=="on"){echo "<td width='90' align='center'><font color='#FFFFFF'>時間</font></td>";}
							if($_GET["longitude"]=="on"){echo "<td width='90' align='center'><font color='#FFFFFF'>經度</font></td>";}
							if($_GET["latitude"]=="on"){echo "<td width='90' align='center'><font color='#FFFFFF'>緯度</font></td>";}
							if($chart=="temperature"){echo "<td width='115' align='center'><font color='#FFFFFF'>溫度</font></td>";}
							if($chart=="humidity"){echo "<td width='115' align='center'><font color='#FFFFFF'>濕度</font></td>";}
							if($chart=="speed"){echo "<td width='115' align='center'><font color='#FFFFFF'>速度</font></td>";}
						echo "</tr></table>";
						
						echo "<div style='height:200px;overflow:auto;'><table border='1' align='center'>";
						while($row_result5=mysql_fetch_assoc($result5))
						{
							echo "<tr>";
								//根據使用者所勾選的項目呈現資料
								if($_GET["date"]=="on"){echo "<td width='95' align='center'>".$row_result5["date"]."</td>";}
								if($_GET["time"]=="on"){echo "<td width='90' align='center'>".$row_result5["time"]."</td>";}
								if($_GET["longitude"]=="on"){echo "<td width='90' align='center'>
									".number_format($row_result5["longitude"],3)."</td>";}
								if($_GET["latitude"]=="on"){echo "<td width='90' align='center'>
									".number_format($row_result5["latitude"],3)."</td>";}
								if($chart=="temperature")
									{echo "<td width='100' align='center'>".$row_result5["temperature"]."</td>";}
								if($chart=="humidity"){echo "<td width='100' align='center'>".$row_result5["humidity"]."</td>";}
								if($chart=="speed"){echo "<td width='100' align='center'>".$row_result5["speed"]."</td>";}
							echo "</tr>";
						}
						echo "</table></div>";
					}
					echo "<br>
						<input type='image' name='choose' id='choose' value='圖表呈現' src='http://140.127.22.147/map/png/choose_1.png'>
						<input type='image' name='choose' id='choose' value='歷史紀錄' src='http://140.127.22.147/map/png/choose_2.png'>
					</form>";
				}
			}
?>
</div>
</body>
</html>