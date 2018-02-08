<?php
  session_start();
  
  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");
  include("../functions/chartFunctions.php");
 
  if(!isset($_SESSION['Username'])){
	  header("Location: login.php");
	  die();
  }
	  
  if(isset($_POST['UpdateChartView']))
  {
  $ChooseUser = $_POST['DD'];	
  $Date = date("Y-m-d", strtotime($_POST['Calendar']));
  
  if($_POST['DDTimeframe'] == "Day")
  {
	  $NumOfDays = 1;
	  
  }elseif($_POST['DDTimeframe'] == "Week")
  {
	  $NumOfDays = 7;
	  
  }elseif($_POST['DDTimeframe'] == "Month")
  {
	  $NumOfDays = 30;
  }
  
  $value = get_users_values($_POST['DD']);
  $DeviceID = $value->device_id;
  
  print_chart($Date, $NumOfDays, $DeviceID, "Battery Utilisation Chart", 500, 300, "Charts" );
  #start date, number of days, device id, title, width, height, div id
  
  #echo $_POST['Calendar'];
  }
  
  #Day, week and month options
  
  
?>
<!DOCTYPE html>
<html>
  <head>
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
		<form action= "adminCharts.php" method = "POST">
		
			<div id="DropDown" style="padding-top: 10px; text-align: Left;">
			<label> Please Select a User: </label>
			<select class="form-dropdown" style="width:150px" id="Dropdown" name="DD">
				<?php echo retrieve_users_DropDown(); ?>			
			</select>
			</div>
			
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
	  
		
		
		<br>
		</form>
		
		<div id= "Charts">
		</div>
		
	</div>

	  
      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
