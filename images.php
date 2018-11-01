<?php
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
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style>
	body,input { font-size: 9pt; }
	html { height: 100% }  
	body { height: 100%; margin: 0px; padding: 0px }  
	#map_canvas { height: 100% }        
</style>
</head>

<body bgcolor="#247894">
<div align="center">
	<table width="640" border="0" align="center" height="350">
		<tr>
				<?php
					if(!isset($_GET["button"]))
					{
						echo "<td width='440'  align='right'>";
						echo "<img src='http://140.127.22.147/map/png/car4.png' height='340'>";
					}
					else 
					{
						echo "<td width='440'  align='center'>";
						if($_GET["button"]=="三軸感測器(一)")
						{
							echo "
								<table width='400' border='1' align='center'>
									<tr>
										<th bgcolor='#92d94f'>日期</th>
										<th bgcolor='#92d94f'>時間</th>
										<th bgcolor='#92d94f'>x軸</th>
										<th bgcolor='#92d94f'>y軸</th>
										<th bgcolor='#92d94f'>z軸</th>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-30</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-29</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-28</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-27</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-26</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-25</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-24</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-23</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-22</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-21</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
								</table>
							";
						}
						else if($_GET["button"]=="三軸感測器(二)")
						{
							echo "
								<table width='400' border='1' align='center'>
									<tr>
										<th bgcolor='#92d94f'>日期</th>
										<th bgcolor='#92d94f'>時間</th>
										<th bgcolor='#92d94f'>x軸</th>
										<th bgcolor='#92d94f'>y軸</th>
										<th bgcolor='#92d94f'>z軸</th>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-30</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-29</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-28</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-27</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-26</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-25</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-24</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-23</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-22</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-21</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
										<td align='center'><font color='#FFFFFF'>g  -2.5  2.5</font></td>
									</tr>
								</table>
							";
						}
						else if($_GET["button2"]=="圖表呈現" || !isset($_GET["button2"]))
						{
							//變數設定
							$chf = "bg,s,E8E8E8";
							$cht = "lc";//圖表類型,lc為折線圖
							$chs = "350x200";//圖表大小,寬*長
							$chxl = "|30|29|28|27|26|25|24|23|22|21";
							$chxr = "0,0,10|1,0,100";//y軸(1:y軸,0:x軸)
							$chds = "0,100";//y軸最小值和最大值
							$chxs = "0,EA3131,11.5,0,l,676767|1,000000,11.5,0,lt,676767";//兩邊單位的顏色
							$chco = "3072F3";//背景顏色
							$chdlp = "t";//線條名稱位置,top
							$chls = "2";//線條粗細小
							$chtt = "  ";
							$chg = "-1,-1,0,0";
							//
							if($_GET["button"]=="時速")
							{
								$chd ="70,75,80,85,95,96,96,90,85,80";
								drawChart($chf,$cht,$chs,$chxl,$chxr,$chds,$chxs,$chco,$chdlp,$chls,$chtt,$chg,$chd);
								echo "<font color='#FF0000'><br>2014/06</font>";
								echo "<font size='+1'><br>單位：km/hr</font>";
								
							}
							else if($_GET["button"]=="轉速")
							{
								$chd ="70,75,80,85,95,96,96,90,85,80";
								drawChart($chf,$cht,$chs,$chxl,$chxr,$chds,$chxs,$chco,$chdlp,$chls,$chtt,$chg,$chd);
								echo "<font color='#FF0000'><br>2014/06</font>";
								echo "<font size='+1'><br>單位：rpm</font>";
							}
							else if($_GET["button"]=="空氣流量")
							{
								$chd ="70,75,84,80,95,96,96,90,85,85";
								drawChart($chf,$cht,$chs,$chxl,$chxr,$chds,$chxs,$chco,$chdlp,$chls,$chtt,$chg,$chd);
								echo "<font color='#FF0000'><br>2014/06</font>";
								echo "<font size='+1'><br>單位：grams/sec</font>";
							}
							else if($_GET["button"]=="引擎冷卻溫度")
							{
								$chd ="80,85,84,90,95,96,96,90,85,85";
								drawChart($chf,$cht,$chs,$chxl,$chxr,$chds,$chxs,$chco,$chdlp,$chls,$chtt,$chg,$chd);
								echo "<font color='#FF0000'><br>2014/06</font>";
								echo "<font size='+1'><br>單位：°C</font>";
							}
							echo "
							<form action='' method='get' name='form2' id='form2'>
								<input type='image' name='button2' id='button2' value='圖表呈現' src='http://140.127.22.147/map/png/choose_1.png'>
								<input type='image' name='button2' id='button2' value='歷史紀錄' src='http://140.127.22.147/map/png/choose_2.png'>
								<input type='hidden' name='button' id='button' value='".$_GET["button"]."'>
							</form>
							";
						}
						else if($_GET["button2"]=="歷史紀錄")
						{
							echo "<table width='400' border='1' align='center'>";
							if($_GET["button"]=="時速")
							{
								$history=array("70","75","80","85","95","96","96","90","85","80","km/hr");
							}
							else if($_GET["button"]=="轉速")
							{
								$history=array("70","75","80","85","95","96","96","90","85","80","rpm");
							}
							else if($_GET["button"]=="空氣流量")
							{
								$history=array("70","75","84","80","95","96","96","90","85","85","grams/sec");
							}
							else if($_GET["button"]=="引擎冷卻溫度")
							{
								$history=array("80","84","85","90","95","96","96","90","85","85","°C");
							}
								echo "
									<tr>
										<th bgcolor='#92d94f'>日期</th>
										<th bgcolor='#92d94f'>時間</th>
										<th bgcolor='#92d94f'>紀錄 (單位：".$history[10].")</th>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-30</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[0]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-29</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[1]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-28</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[2]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-27</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[3]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-26</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[4]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-25</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[5]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-24</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[6]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-23</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[7]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-22</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[8]."</font></td>
									</tr>
									<tr>
										<td align='center'><font color='#FFFFFF'>2014-06-21</font></td>
										<td align='center'><font color='#FFFFFF'>10:05:00</font></td>
										<td align='center'><font color='#FFFFFF'>".$history[9]."</font></td>
									</tr>
								";
							echo "</table>";
							echo "
							<form action='' method='get' name='form2' id='form2'>
								<input type='image' name='button2' id='button2' value='圖表呈現' src='http:/140.127.22.147/map/png/choose_1.png'>
								<input type='image' name='button2' id='button2' value='歷史紀錄' src='http:/140.127.22.147/map/png/choose_2.png'>
								<input type='hidden' name='button' id='button' value='".$_GET["button"]."'>
							</form>
							";
						}
					}
				?>
            </td>
			<td width="200"  align="center" valign="middle">
                    <form action='' method='get' name='form1' id='form1'>
                    	 <input type='image' name='button' id='button' value="三軸感測器(一)" src='http://140.127.22.147/map/png/car_1_3.png' width="100%" height="64" style="background-color:#0c2e55">
                         <input type='image' name='button' id='button' value="三軸感測器(二)" src='http://140.127.22.147/map/png/car_2_3.png' width="100%" height="64" style="background-color:#0c2e55">
                         <input type='image' name='button' id='button' value="時速" src='http://140.127.22.147/map/png/car_3_3.png' width="100%" height="64" style="background-color:#0c2e55">
                         <input type='image' name='button' id='button' value="轉速" src='http://140.127.22.147/map/png/car_4_3.png' width="100%" height="64" style="background-color:#0c2e55">
                         <input type='image' name='button' id='button' value="空氣流量" src='http://140.127.22.147/map/png/car_5_3.png' width="100%" height="64" style="background-color:#0c2e55">
                         <input type='image' name='button' id='button' value="引擎冷卻溫度" src='http://140.127.22.147/map/png/car_6_3.png' width="100%" height="64" style="background-color:#0c2e55">
                    </form>
			</td>
		</tr>
	</table>

</div>
</body>
</html>