<?php
	include("../functions/sqlFunctions.php");
	try{
		insert_device_data($_GET['deviceid'], $_GET['batlevel'], $_GET['chargestate']);
	}catch(Exception $e){
		echo "ERROR: " . $e->getMessage();
	}
?>
