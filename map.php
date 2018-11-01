<?php 
	include("connMysql.php");
	$ip="http://140.127.22.147/map/png/";
	//檢查範圍內標點狀況,以利更改標點顏色
	$sql_query3 = "SELECT * FROM `option` 
	WHERE `longitude` < '".$right."' AND `longitude` > '".$left."' AND `latitude` < '".$top."' AND `latitude` > '".$btm."'";
	$result3 = mysql_query($sql_query3);
	while($row_result3=mysql_fetch_assoc($result3))
	{
		//本機標點
		if($row_result3["longitude"]==$row_result_myself["longitude"] && $row_result3["latitude"]==$row_result_myself["latitude"])
		{
			//如果本機異常
			if($row_result3["temperature"]>=$row_result_SAS["temperature"] 
			|| $row_result3["humidity"]>=$row_result_SAS["humidity"] 
			|| $row_result3["speed"]>=$row_result_SAS["speed"])
			{
				$me=$ip."mobile2_2.png";
			}
			//本機正常
			else
			{
				$me=$ip."mobile_2.png";
			}
		}
		//其他裝置
		else 
		{
			//其他裝置異常
			if ($row_result3["temperature"]>=$row_result_SAS["temperature"] 
				|| $row_result3["humidity"]>=$row_result_SAS["humidity"] 
				|| $row_result3["speed"]>=$row_result_SAS["speed"])
			{
				$sql_query_UPDATE = "UPDATE `option` SET ";
				if($row_result3["icon"]==$ip."wsn_3.png")
				{
					$sql_query_UPDATE .= "`icon`='".$ip."wsn3_2.png' ";
				}
				if($row_result3["icon"]==$ip."6LoWPAN_3.png")
				{
					$sql_query_UPDATE .= "`icon`='".$ip."6LoWPAN3_2.png' ";
				}
				if($row_result3["icon"]==$ip."can_bus_2.png")
				{
					$sql_query_UPDATE .= "`icon`='".$ip."can_bus2_2.png' ";
				}
				$sql_query_UPDATE .= "WHERE `id`=".$row_result3["id"];	
				mysql_query($sql_query_UPDATE);
			}
			//其他裝置正常
			else
			{
				$sql_query_UPDATE = "UPDATE `option` SET ";
				if($row_result3["icon"]==$ip."wsn3_2.png")
				{
					$sql_query_UPDATE .= "`icon`='".$ip."wsn_3.png' ";
				}
				if($row_result3["icon"]==$ip."6LoWPAN3_2.png")
				{
					$sql_query_UPDATE .= "`icon`='".$ip."6LoWPAN_3.png' ";
				}
				if($row_result3["icon"]==$ip."can_bus2_2.png")
				{
					$sql_query_UPDATE .= "`icon`='".$ip."can_bus_2.png' ";
				}
				$sql_query_UPDATE .= "WHERE `id`=".$row_result3["id"];	
				mysql_query($sql_query_UPDATE);
			}
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>地圖畫面</title>
<!--利用CSS將畫面等比例縮放-->
<style>
	body,input { font-size: 9pt; }
	html { height: 100% }  
	body { height: 100%; margin: 0px; padding: 0px }  
	#map_canvas { height: 100% }        
</style>
<!--載入Google Map Api-->
<script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.js'></script>   
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<!--設定地圖-->
    <script>
        $(function () {
            //定義地圖中心經緯度 (緯度,經度)
            var latlng = new google.maps.LatLng(<?php echo $row_result_myself["latitude"].",".$row_result_myself["longitude"];?>);
            //設定地圖參數
            var mapOptions = {
				disableDefaultUI: true,//關閉所有控制項目
                zoom: 16, //初始放大倍數
                center: latlng, //中心點所在位置
                mapTypeId: google.maps.MapTypeId.ROADMAP //正常2D道路模式
            };
            //在指定DOM元素中嵌入地圖
            var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
			//設置標點
			<?php
				//從option表單撈出固定範圍內的標點
				$sql_query_marker = "SELECT * FROM `option` WHERE `longitude` < '".$right."' AND `longitude` > '".$left."' AND `latitude` < '".$top."' AND `latitude` > '".$btm."'";
				if($row_result_SAS["type"]!="all")
				{
					$sql_query_marker .= " AND `type` = '".$row_result_SAS["type"]."'";
				}
				$result_marker = mysql_query($sql_query_marker);
				while($row_result_marker=mysql_fetch_assoc($result_marker))
				{
					echo " 
					//標點經緯度(緯度,經度)
					var latlng2 = new google.maps.LatLng(".$row_result_marker["latitude"].",".$row_result_marker["longitude"].");
					//加入標示點(Marker)
           			var marker_".$row_result_marker["id"]." = new google.maps.Marker({
               	 	position: latlng2, //經緯度
					";
					if($row_result_marker["longitude"]==$row_result_myself["longitude"] && $row_result_marker["latitude"]==$row_result_myself["latitude"])
					{
						echo "icon: '".$me."',";//本機標點顏色
					}
					else
					{
						echo "icon: '".$row_result_marker["icon"]."',";//其他裝置標點顏色
					}
					echo "
               		map: map //指定要放置的地圖對象
            		});
					//加入資訊視窗
					var InfoBox_".$row_result_marker["id"]." = new google.maps.InfoWindow({
            		content: '".$row_result_marker["content"]."'
       				});
					// 移動至地標顯示資訊內容
        			google.maps.event.addListener(marker_".$row_result_marker["id"].", 'click', function() {
            		InfoBox_".$row_result_marker["id"].".open(map, marker_".$row_result_marker["id"].");
        			});
					";
				}
			?>
        });
    </script>
</head>
<body  bgcolor="#247894">
<!--地圖呈現-->
<div id="map_canvas" style="width:100%; height:100%"></div>
</body>
</html>