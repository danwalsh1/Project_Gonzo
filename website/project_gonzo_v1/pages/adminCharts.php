<?php
	session_start();
  
	include("../functions/generalFunctions.php");	# Allows functionality from the 'generalFunctions.php' page.
	include("../functions/sqlFunctions.php");	# Allows functionality from the 'sqlFunctions.php' page.
	include("../functions/chartFunctions.php");	# Allows functionality from the 'chartFunctions.php' page.
 

	if(!isset($_SESSION['Username'])){		# Username is pulled as a cookie which would have been stored on your web session (as the website is server side) after the username is called on another page.
		header("Location: login.php");		# If the Username is not set in the generalFunctions.php session the user will get redirected back to the "login.php" page
		die();					# this then stops the php script from being executed any further	
	}
  
	if(isset($_SESSION['admin'])){			 
		if($_SESSION['admin'] == False){	# If the user is trying to access the "adminCharts.php" and is not an admin
			header("Location: home.php");	# the user will be redirected to the home page 
			die();	
		}
	}else{
		header("Location: logout.php");		# If the user is not an admin, the function wont be exicuted further
		die();					# this then stops the php script from being executed any further
	}
	  

	if(isset($_POST['UpdateChartView'])){		# If update chart view has been clicked, using the form information work out the required values.
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
	  

		$tWidth = (int) $_POST['deviceWidth']; #Chart dimensions.
		$width = $tWidth - (($tWidth/100)*10);
		$height = ($width/100) * 60;
  
		$value = get_users_values($_POST['DD']);
		$DeviceID = $value[3];
  

		print_chart($Date, $NumOfDays, $DeviceID, $title, $width, $height, "Charts", $chartType); #Using the selected data, as per the options selected, to run the print chart function on the chartFunctions.php page.
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
					<table>
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
				
				
				<div id= "Charts">
				</div>
		
			</div>
	    

			<div id="Footer">
			</div>
		</div>
	</body>
</html>
