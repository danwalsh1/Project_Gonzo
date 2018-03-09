<?php
	session_start();
  
	include("../functions/generalFunctions.php");
	include("../functions/sqlFunctions.php");
	include("../functions/chartFunctions.php");
 
	if(!isset($_SESSION['Username'])){
		header("Location: login.php");
		die();
	}
  
	if(isset($_SESSION['admin'])){
		if($_SESSION['admin'] == False){
			header("Location: home.php");
			die();
		}
	}else{
		header("Location: logout.php");
		die();
	}
	  
	if(isset($_POST['UpdateChartView'])){
		$ChooseUser = $_POST['DD'];	
		$Date = date("Y-m-d", strtotime($_POST['Calendar']));
  
		if($_POST['DDTimeframe'] == "Day"){
			$NumOfDays = 1;
		}elseif($_POST['DDTimeframe'] == "Week"){
			$NumOfDays = 7;
		}elseif($_POST['DDTimeframe'] == "Month"){
			$NumOfDays = 30;
		}
		if($_POST['DDChartType'] == "Battery Level"){
			$chartType = "batteryLevel";
			$title = "Battery Level Chart";
		}elseif($_POST['DDChartType'] == "Battery Charging State"){
			$chartType = "batteryState";
			$title = "Battery Charge State Chart";
		}elseif($_POST['DDChartType'] == "CPU Usage"){
			$chartType = "cpuUsage";
			$title = "CPU Usage Chart";
		}
	  
		$tWidth = (int) $_POST['deviceWidth'];
		$width = $tWidth - (($tWidth/100)*10);
		$height = ($width/100) * 60;
  
		$value = get_users_values($_POST['DD']);
		$DeviceID = $value[3];
  
		print_chart($Date, $NumOfDays, $DeviceID, $title, $width, $height, "Charts", $chartType);
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
				<div style="font-family:arial">
					<table align="left">
						<form action= "adminCharts.php" method = "POST">
							<tr>
								<td>
									<label> Please select a User: </label>
								</td>
								<td>
									<select class="form-dropdown" style="width:150px" id="Dropdown" name="DD">
										<?php echo retrieve_users_DropDown(); ?>			
									</select>
								</td>
							</tr>
				
							<tr>
								<td>
									<label> Please select period to report: </label>
								</td>
								<td>
									<select class="form-dropdown" style="width:150px;font-family:arial" id="DropdownTimeframe" name="DDTimeframe">
										<option>Day</option>
										<option>Week</option>
										<option>Month</option>
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
				<br />
		
				<div id= "Charts">
				</div>
		
			</div>
	    
			<div id="Footer">
			</div>
		</div>
	</body>
</html>
