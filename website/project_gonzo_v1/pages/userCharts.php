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
	
	print_chart($Date, $NumOfDays, $userValues->device_id, "Battery Utilisation Chart", 1000, 600, "dataChart");
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
			<nav>
				<ul>
					<?php displayMainMenu(); ?>
				</ul>
			</nav>
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
