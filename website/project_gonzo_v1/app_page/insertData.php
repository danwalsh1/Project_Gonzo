<?php
	include("../functions/sqlFunctions.php");
	
	if(isset($_GET['batlevel'])){	
		insert_battery_data($_GET['deviceid'], $_GET['batlevel'], $_GET['chargestate']);
	}elseif(isset($_GET['cpu'])){
		insert_cpu_data($_GET['deviceid'], $_GET['cpu']);
	}
?>

