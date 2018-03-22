<?php
	session_start(); #Starts a session for a client to start working with.
  
	include("../functions/generalFunctions.php"); #Provides access to the core reusable functions and code.
	include("../functions/sqlFunctions.php");
	include("../functions/chartFunctions.php");
  
	if(!isset($_SESSION['Username'])){ #Checks a username is present and stored in SESSION.
		header("Location: login.php"); #Redirects to login.php if true.
		die(); #Stops php script running any further.
	}
  
	$userValues = get_users_values($_SESSION['Username']); #Pulls the function from the sqlFunctions page to retrieve the user data.
  
	if(isset($_POST['UpdateChartView'])){ #After the button is pressed, starts the if statement block.
		$Date = date("Y-m-d", strtotime($_POST['Calendar']));#Stores date in a usuable functional format for when a calendar date is chosen.
		if($_POST['DDTimeframe'] == "Day"){
			$NumOfDays = 1; #Specifies a day for the day dropdown.
		}elseif($_POST['DDTimeframe'] == "Week"){
			$NumOfDays = 7; #Specifies 7 days for the week dropdown.
		}elseif($_POST['DDTimeframe'] == "Month"){
			$NumOfDays = 30; #Specifies 30 days for a month.
		}
		
		if($_POST['DDChartType'] == "Battery Level"){ #Checks which data has been selected then passes in the relevant title.
			$chartType = "batteryLevel";
			$title = "Battery Level Chart";
		}elseif($_POST['DDChartType'] == "Battery Charging State"){
			$chartType = "batteryState";
			$title = "Battery Charge State Chart";
		}elseif($_POST['DDChartType'] == "CPU Usage"){
			$chartType = "cpuUsage";
			$title = "CPU Usage Chart";
		}
	
		$tWidth = (int) $_POST['deviceWidth'];#Dimensional settings for the chart.
		$width = $tWidth - (($tWidth/100)*10);
		$height = ($width/100) * 60;
	
		print_chart($Date, $NumOfDays, $userValues[3], $title, $width, $height, "dataChart", $chartType); #Display the chart with values passed in as specified above.
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
		<title>Charts | Project Gonzo</title>
	</head>
	<body>
		<div id="Page">
			<div id="Header">
				<div id="Menu">
					<?php displayMainMenu(); ?>
				</div>
			</div>
      
			<div id="Content">
				<h2 style="font-family:arial">Device ID: <?php echo $userValues[3] #pulls in the result from the get_users_values() function. ?></h2>
				
				<div style="font-family:arial">
					<table>
						<form action="userCharts.php" method="POST">
							<tr>
								<td>
									<label> Period to report: </label>
								</td>
								<td>
									<select class="form-dropdown" style="width:150px" id="DropdownTimeframe" name="DDTimeframe">
										<option> Day </option>
										<option> Week </option>
										<option> Month </option>
									</select>
								</td>
							</tr>
			
							<tr>
								<td>
									<label> Please select a start date: </label>
								</td>
								<td>
									<input type= "date" name="Calendar">
								</td>
							</tr>
			
							<tr>
								<td>
									<label> Please select data to report: </label>
								</td>
								<td>
									<select class="form-dropdown" style="width:150px" id="DropdownChartType" name="DDChartType">
										<option>Battery Level</option>
										<option>Battery Charging State</option>
										<option>CPU Usage</option>
									</select>
								</td>
							</tr>
			
							<tr>
								<td>
								</td>
								<td>
									<input type="hidden" id="hDeviceWidth" name="deviceWidth" value="test" runat="server">
								</td>
							</tr>
			
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Show Charts" name="UpdateChartView">	
								</td>
							</tr>
						</form>
					</table>
				</div>
				
				<script>
					document.getElementById('hDeviceWidth').value=screen.width;
				</script>
				
				<div id="dataChart">
				</div>
			</div>
      
			<div id="Footer">
			</div>
		</div>
	</body>
</html>
