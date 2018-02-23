<?php
  session_start();
  
  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");
  include("../functions/chartFunctions.php");
  
  if(!isset($_SESSION['Username'])){
	  header("Location: login.php");
	  die();
  }
  
  $userValues = get_users_values($_SESSION['Username']);
  
  if(isset($_POST['UpdateChartView'])){
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
		$title = "Battery Charge State Chart":
	  }elseif($_POST['DDChartType'] == "CPU Usage"){
		$chartType = "cpuUsage";
		$title = "CPU Usage Chart";
	  }
	
	print_chart($Date, $NumOfDays, $userValues->device_id, $title, 1000, 600, "dataChart", $chartType);
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
		<h2>Device ID: <?php echo $userValues->device_id; ?></h2>
		<form action="userCharts.php" method="POST">
			<div id="Timeframe" style="padding-top: 10px; text-align: left;">
			<label> Period to report: </label>
			<select class="form-dropdown" style="width:150px" id="DropdownTimeframe" name="DDTimeframe">
				<option> Day </option>
				<option> Week </option>
				<option> Month </option>
			</select>
			</div>
			
			<div id = "Calendar" style="padding-top: 10px; text-align: left;">
			<label> Please select a start date: </label>
			<input type= "date" name="Calendar">
			</div>
			
			<div id = "ChartType" style="padding-top: 10px; text-align: left;">
				<label> Please select data to report: </label>
				<select class="form-dropdown" style="width:150px" id="DropdownChartType" name="DDChartType">
					<option>Battery Level</option>
					<option>Battery Charging State</option>
					<option>CPU Usage</option>
				</select>
			</div>
		
			<div id="ChartsView" style="padding-top: 10px;padding-left: 50px; text-align: left;">
				<br />
				<br />
				<input type="submit" value="Show Charts" name="UpdateChartView">	
			</div>
		</form>
		<div id="dataChart"></div>
      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
