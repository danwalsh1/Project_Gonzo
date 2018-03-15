<?php
	include("../functions/sqlFunctions.php"); #Allows functinality from the 'sqlFunctions.php' page.
	
	if(isset($_GET['batlevel'])){	#If 'batlevel' is inside the URL then the if statement is accessed.
		insert_battery_data($_GET['deviceid'], $_GET['batlevel'], $_GET['chargestate']); #Runs the 'insert_battery_data_' function and passes in the variables 'deviceid', 'batlevel' and 'chargestate'.
	}elseif(isset($_GET['cpu'])){	#If 'cpu' is inside the URL then the if statetment is accessed.
		insert_cpu_data($_GET['deviceid'], $_GET['cpu']); #Runs the 'insert_cpu_data' and passes in then variables 'deviceid' and 'cpu'.
	}
?>

