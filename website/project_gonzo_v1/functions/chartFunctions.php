<?php
	// No need to include sqlFunctions due to the chart pages already doing this.
	
	function makeGoogleChart($title, $width, $height, $divID, $dataString, $vAxis, $hAxis){
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
						'vAxis': { title:'" . $vAxis . "'},
						'hAxis': { title:'" . $hAxis . "'},
						'width':" . $width . ",
						'height':" . $height . "};
					
					var chart = new google.visualization.LineChart(document.getElementById('" . $divID ."'));
					chart.draw(data, options);
				}
		</script>
	";
	}
	
	function checkArrayForZero($arrayToCheck){
		# This function is used to check if an array is full of zero values
		# Returns true if all values are zero, else returns false
		$count = 0;
		while($count < count($arrayToCheck)){
			if($arrayToCheck[$count] != 0){
				return false;
			}
			$count += 1;
		}
		return true;
	}

	function get_avg_device_data_day($startDate, $endDate, $deviceId, $chartType){
		# Start date is inclusive, end date is not inclusive
		$connect = connect_db();
		if($chartType == "cpuUsage"){
			$sql = "SELECT * FROM device_cpu_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		}else{
			$sql = "SELECT * FROM device_battery_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		}
		$result = mysqli_query($connect, $sql);
		if(mysqli_num_rows($result) != 0){
			if($chartType == "cpuUsage"){
				while($row = mysqli_fetch_array($result)){
					$cpuPerArray[] = $row['cpu_percent_avg'];
				}
			}else{
				while($row = mysqli_fetch_array($result)){
					$batLevelArray[] = $row['battery_level'];
					$batStateArray[] = $row['charging_state'];
				}
			}
		}else{
			return 0;
		}
		if($chartType == "batteryLevel" or $chartType == "batteryState"){
			$count = 0;
			$numOfCharging = 0;
			$avg = array(0, 0);
			while($count < count($batLevelArray)){
				$avg[0] = $avg[0] + $batLevelArray[$count];
				if($batStateArray[$count] == 1){
					$numOfCharging = $numOfCharging + 1;
				}
				$count += 1;
			}
			if($numOfCharging >= round(count($batStateArray) / 2)){
				$avg[1] = 1;
			}else{
				$avg[1] = 0;
			}
			
			$avg[0] = $avg[0] / count($batLevelArray);
		}elseif($chartType == "cpuUsage"){
			$count = 0;
			$avg = 0;
			while($count < count($cpuPerArray)){
				$avg = $avg + $cpuPerArray[$count];
				$count += 1;
			}
			$avg = $avg / count($cpuPerArray);
		}
		return $avg;
	}
	
	function get_avg_device_data_dates($startDate, $numOfDays, $deviceId, $chartType){
		$count = 0;
		while($count < $numOfDays){
			$result = get_avg_device_data_day($startDate, date("Y-m-d", strtotime("+1 day", strtotime($startDate))), $deviceId, $chartType);
			if($chartType == "cpuUsage"){
				$avgCpuPerArray[] = round($result);
			}else{
				$avgLevelArray[] = round($result[0]);
				$avgStateArray[] = $result[1];
			}
			$dateArray[] = $startDate;
			$startDate = date("Y-m-d", strtotime("+1 day", strtotime($startDate)));
			$count += 1;
		}
		
		if($chartType == "cpuUsage"){
			if(checkArrayForZero($avgCpuPerArray)){
				$avgCpuPerArray = [0];
				$dateArray = ['No Data'];
			}
			$resultArray = array($avgCpuPerArray, $dateArray);
		}else{
			if(checkArrayForZero($avgLevelArray)){
				$avgLevelArray = [0];
				$avgStateArray = [0];
				$dateArray = ['No Data'];
			}
			$resultArray = array($avgLevelArray, $dateArray, $avgStateArray);
		}
		return $resultArray;
	}
	
	function get_device_data_day($startDate, $endDate, $deviceId, $chartType){
		# Start date is inclusive, end date is not inclusive
		$connect = connect_db();
		if($chartType == "cpuUsage"){
			$sql = "SELECT * FROM device_cpu_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		}else{
			$sql = "SELECT * FROM device_battery_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		}
		$result = mysqli_query($connect, $sql);
		if(mysqli_num_rows($result) != 0){
			if($chartType == "cpuUsage"){
				while($row = mysqli_fetch_array($result)){
					$cpuPerArray[] = $row['cpu_percent_avg'];
					$dateTimeArray[] = $row['date'];
				}
			}else{
				while($row = mysqli_fetch_array($result)){
					$batLevelArray[] = $row['battery_level'];
					$dateTimeArray[] = $row['date'];
					if($row['charging_state'] == 1){
						$batStateArray[] = 1;
					}else{
						$batStateArray[] = 0;
					}
				}
			}
		}else{
			if($chartType == "cpuUsage"){
				$cpuPerArray[] = 0;
			}else{
				$batLevelArray[] = 0;
				$batStateArray[] = 0;
			}
			$dateTimeArray[] = "No Data";
		}
		
		if($chartType == "cpuUsage"){
			return array($cpuPerArray, $dateTimeArray);
		}else{
			return array($batLevelArray, $dateTimeArray, $batStateArray);
		}
	}
	
	function print_chart($startDate, $numOfDays, $deviceId, $title = 'Data Chart', $width = 500, $height = 300, $divId = 'chartDiv', $chartType){
		if($chartType == "batteryLevel"){
			if($numOfDays == 1){
				$result = get_device_data_day($startDate, date("Y-m-d", strtotime("+1 day", strtotime($startDate))), $deviceId, $chartType);
			
				$count = 0;
				$dataString = "[['Date', 'Battery Level'],";
				while($count < count($result[0])-1){
					$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
					$count += 1;
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
			
				makeGoogleChart($title, $width, $height, $divId, $dataString, "Battery Level (%)", "Date & Time");
			}else{
				$result = get_avg_device_data_dates($startDate, $numOfDays, $deviceId, $chartType);
		
				$count = 0;
				$dataString = "[['Date', 'Avg Battery Level'],";
				if(count($result[1]) != 1){
					while($count < $numOfDays-1){
						$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
						$count += 1;
					}
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
			
				makeGoogleChart($title, $width, $height, $divId, $dataString, "Battery Level (%)", "Date");
			}
		}elseif($chartType == "batteryState"){
			if($numOfDays == 1){
				$result = get_device_data_day($startDate, date("Y-m-d", strtotime("+1 day", strtotime($startDate))), $deviceId, $chartType);
			
				$count = 0;
				$dataString = "[['Date', 'Charging State'],";
				while($count < count($result[0])-1){
					$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[2][$count] . "],";
					$count += 1;
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[2][$count] . "]]";
			
				makeGoogleChart($title, $width, $height, $divId, $dataString, "Battery Charging State", "Date & Time");
			}else{
				$result = get_avg_device_data_dates($startDate, $numOfDays, $deviceId, $chartType);
		
				$count = 0;
				$dataString = "[['Date', 'Avg Charging State'],";
				if(count($result[1]) != 1){
					while($count < $numOfDays-1){
						$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[2][$count] . "],";
						$count += 1;
					}
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[2][$count] . "]]";
			
				makeGoogleChart($title, $width, $height, $divId, $dataString, "Battery Charging State", "Date");
			}
		}elseif($chartType == "cpuUsage"){
			if($numOfDays == 1){
				$result = get_device_data_day($startDate, date("Y-m-d", strtotime("+1 day", strtotime($startDate))), $deviceId, $chartType);
			
				$count = 0;
				$dataString = "[['Date', 'Avg CPU Usage'],";
				if(count($result[1]) != 1){
					while($count < count($result[0])-1){
						$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
						$count += 1;
					}
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
			
				makeGoogleChart($title, $width, $height, $divId, $dataString, "CPU Avg Usage", "Date & Time");
			}else{
				$result = get_avg_device_data_dates($startDate, $numOfDays, $deviceId, $chartType);
		
				$count = 0;
				$dataString = "[['Date', 'Avg CPU Usage'],";
				if(count($result[1]) != 1){
					while($count < $numOfDays-1){
						$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
						$count += 1;
					}
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
			
				makeGoogleChart($title, $width, $height, $divId, $dataString, "CPU Avg Usage (Per day)", "Date");
			}
		}
	}
?>
