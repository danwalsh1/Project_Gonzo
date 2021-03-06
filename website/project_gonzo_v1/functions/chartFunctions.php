<?php
	# No need to include sqlFunctions due to the chart pages already doing this.
	
	function makeGoogleChart($title, $width, $height, $divID, $dataString, $vAxis, $hAxis){
		# Uses Google Charts (https://developers.google.com/chart/)
		# This function takes in a title, width, height, div tag ID, a string of data to be displayed in the table, a vertical axis label and a horizontal axis label.
		# This function doesn't return any values. The function echo's Google Charts javascript into the page displaying the chart.
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
		# This function takes in a start date and end date, in the format Y-m-d, a device ID and the type of chart to be displayed(cpuUsage, batteryLevel or batteryState).
		# This function is used to find the average of the given data type for the given period. Should be used to find average for one day.
		# Start date is inclusive, end date is not inclusive
		$connect = connect_db();
		
		# Get data from database
		if($chartType == "cpuUsage"){
			$sql = "SELECT * FROM device_cpu_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		}else{
			$sql = "SELECT * FROM device_battery_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		}
		$result = mysqli_query($connect, $sql);
		
		# Check that data has been found
		if(mysqli_num_rows($result) != 0){
			if($chartType == "cpuUsage"){
				# Store each data element in an array
				while($row = mysqli_fetch_array($result)){
					$cpuPerArray[] = $row['cpu_percent_avg'];
				}
			}else{
				# Store each data element in the relevant array
				while($row = mysqli_fetch_array($result)){
					$batLevelArray[] = $row['battery_level'];
					$batStateArray[] = $row['charging_state'];
				}
			}
		}else{
			# No data found
			return 0;
		}
		
		# Prepare the returned variable ($avg)
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
		# Return the prepared variable ($avg)
		return $avg;
	}
	
	function get_avg_device_data_dates($startDate, $numOfDays, $deviceId, $chartType){
		# This function takes in a start date in the format Y-m-d, the number of days after the start date (integer), a device ID and the type of chart to be displayed(cpuUsage, batteryLevel or batteryState).
		# This function is used to find the average of the given data type for each day over the given period.
		# Start date is inclusive
		$count = 0;
		# Get average for each day and store in relevant array.
		while($count < $numOfDays){
			#  Get average for one day.
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
		
		# Check arrays for all elements being zero. If all elements are zero, display message showing that there is no data for the given dates.
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
		# Return the array of arrays that holds data to be inserted into the chart.
		return $resultArray;
	}
	
	function get_device_data_day($startDate, $endDate, $deviceId, $chartType){
		# This function takes in a start date and end date, in the format Y-m-d, a device ID and the type of chart to be displayed(cpuUsage, batteryLevel or batteryState).
		# This function is used to find all data of the given data type for the given period.
		# Start date is inclusive, end date is not inclusive. Should only be used when displaying one day on a chart.
		$connect = connect_db();
		if($chartType == "cpuUsage"){
			$sql = "SELECT * FROM device_cpu_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		}else{
			$sql = "SELECT * FROM device_battery_data WHERE date>='" . $startDate . "' AND date<'" . $endDate . "' AND device_id='" . $deviceId . "'";
		}
		$result = mysqli_query($connect, $sql);
		if(mysqli_num_rows($result) != 0){
			# Store data in relevant array.
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
			# Store information to show that no data is available for the given date(s).
			if($chartType == "cpuUsage"){
				$cpuPerArray[] = 0;
			}else{
				$batLevelArray[] = 0;
				$batStateArray[] = 0;
			}
			$dateTimeArray[] = "No Data";
		}
		
		# Return the relevant array.
		if($chartType == "cpuUsage"){
			return array($cpuPerArray, $dateTimeArray);
		}else{
			return array($batLevelArray, $dateTimeArray, $batStateArray);
		}
	}
	
	function print_chart($startDate, $numOfDays, $deviceId, $title = 'Data Chart', $width = 500, $height = 300, $divId = 'chartDiv', $chartType){
		# This function takes in a start date in the format Y-m-d, the number of days after the start date (integer), a device ID, the title of the chart (default is 'Data Chart' if no other title is given), the width and height of the chart (in pixels), the <div> tag id where the chart will be displayed and the type of chart to be displayed(cpuUsage, batteryLevel or batteryState).
		# This function is used to create and echo out the Google Chart javascript to the webpage with the required data, that is fetched using the functions above.
		# Start date is inclusive
		if($chartType == "batteryLevel"){
			if($numOfDays == 1){
				# Get array of required data.
				$result = get_device_data_day($startDate, date("Y-m-d", strtotime("+1 day", strtotime($startDate))), $deviceId, $chartType);
			
				$count = 0;
				# Create string of data to be passed into the Google Chart javascript.
				$dataString = "[['Date', 'Battery Level'],";
				while($count < count($result[0])-1){
					$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
					$count += 1;
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
				
				# Call to the function that echos out the Google Charts javascript.
				makeGoogleChart($title, $width, $height, $divId, $dataString, "Battery Level (%)", "Date & Time");
			}else{
				# Get array of required data.
				$result = get_avg_device_data_dates($startDate, $numOfDays, $deviceId, $chartType);
		
				$count = 0;
				# Create string of data to be passed into the Google Chart javascript.
				$dataString = "[['Date', 'Avg Battery Level'],";
				if(count($result[1]) != 1){
					while($count < $numOfDays-1){
						$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
						$count += 1;
					}
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
				
				# Call to the function that echos out the Google Charts javascript.
				makeGoogleChart($title, $width, $height, $divId, $dataString, "Battery Level (%)", "Date");
			}
		}elseif($chartType == "batteryState"){
			if($numOfDays == 1){
				# Get array of required data.
				$result = get_device_data_day($startDate, date("Y-m-d", strtotime("+1 day", strtotime($startDate))), $deviceId, $chartType);
			
				$count = 0;
				# Create string of data to be passed into the Google Chart javascript.
				$dataString = "[['Date', 'Charging State'],";
				while($count < count($result[0])-1){
					$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[2][$count] . "],";
					$count += 1;
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[2][$count] . "]]";
				
				# Call to the function that echos out the Google Charts javascript.
				makeGoogleChart($title, $width, $height, $divId, $dataString, "Battery Charging State", "Date & Time");
			}else{
				# Get array of required data.
				$result = get_avg_device_data_dates($startDate, $numOfDays, $deviceId, $chartType);
		
				$count = 0;
				# Create string of data to be passed into the Google Chart javascript.
				$dataString = "[['Date', 'Avg Charging State'],";
				if(count($result[1]) != 1){
					while($count < $numOfDays-1){
						$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[2][$count] . "],";
						$count += 1;
					}
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[2][$count] . "]]";
				
				# Call to the function that echos out the Google Charts javascript.
				makeGoogleChart($title, $width, $height, $divId, $dataString, "Battery Charging State", "Date");
			}
		}elseif($chartType == "cpuUsage"){
			if($numOfDays == 1){
				# Get array of required data.
				$result = get_device_data_day($startDate, date("Y-m-d", strtotime("+1 day", strtotime($startDate))), $deviceId, $chartType);
			
				$count = 0;
				# Create string of data to be passed into the Google Chart javascript.
				$dataString = "[['Date', 'Avg CPU Usage'],";
				if(count($result[1]) != 1){
					while($count < count($result[0])-1){
						$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
						$count += 1;
					}
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
				
				# Call to the function that echos out the Google Charts javascript.
				makeGoogleChart($title, $width, $height, $divId, $dataString, "CPU Avg Usage", "Date & Time");
			}else{
				# Get array of required data.
				$result = get_avg_device_data_dates($startDate, $numOfDays, $deviceId, $chartType);
		
				$count = 0;
				# Create string of data to be passed into the Google Chart javascript.
				$dataString = "[['Date', 'Avg CPU Usage'],";
				if(count($result[1]) != 1){
					while($count < $numOfDays-1){
						$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
						$count += 1;
					}
				}
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
				
				# Call to the function that echos out the Google Charts javascript.
				makeGoogleChart($title, $width, $height, $divId, $dataString, "CPU Avg Usage (Per day)", "Date");
			}
		}
	}
?>
