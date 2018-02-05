<?php
	function makeGoogleChart($title, $width, $height, $divID, $dataString){
		# Uses Google Charts
		echo "
			<!--Uses Google Charts-->
			<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
			<script type=\"text/javascript\">
				google.charts.load('current', {'packages':['corechart']});
				
				google.charts.setOnLoadCallback(drawChart);
				
				function drawChart(){
					var data = google.visualization.arrayToDataTable(" . $dataString . ");
					
					var options = {'title':'" . $title ."',
						'width':" . $width . ",
						'height':" . $height . "};
					
					var chart = new google.visualization.LineChart(document.getElementById('" . $divID ."'));
					chart.draw(data, options);
				}
		</script>
	";
	}

	function get_avg_device_data_day($startDate, $endDate, $deviceId){
		# Start date is inclusive, end date is not inclusive
		$connect = connect_db();
		#$sql = "SELECT * FROM device_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		$sql = "SELECT * FROM device_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "'";
		$result = mysqli_query($connect, $sql);
		if(mysqli_num_rows($result) != 0){
			while($row = mysqli_fetch_array($result)){
				$batLevelArray[] = $row['battery_level'];
			}
		}else{
			echo "ERROR";
		}
		$count = 0;
		$avg = 0;
		while($count < count($batLevelArray)){
			$avg = $avg + $batLevelArray[$count];
			$count += 1;
		}
		
		$avg = $avg / count($batLevelArray);
		return $avg;
	}
	
	function get_avg_device_data_dates($startDate, $numOfDays, $deviceId){
		$count = 0;
		while($count < $numOfDays){
			#echo get_avg_device_data_day($startDate, strtotime("+1 day", strtotime($startDate)), $deviceId);
			#echo date("Y-m-d", $startDate);
			$avgLevelArray[] = get_avg_device_data_day($startDate, date("Y-m-d", strtotime("+1 day", strtotime($startDate))), $deviceId);
			$startDate = date("Y-m-d", strtotime("+1 day", strtotime($startDate)));
			$count += 1;
		}
		
		return $avgLevelArray;
	}
?>
