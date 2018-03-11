<?php

	session_start(); #Starts a session.

	include("../functions/generalFunctions.php");

	if(isset($_SESSION['Username']) == false){
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
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
		<title>Downloads | Project Gonzo</title> <!--Project title -->
	</head>
	<body>
		<div id="Page">
			<div id="Header">
				<div id="Menu">
					<?php displayMainMenu(); ?>
				</div>
			</div>
		<div style = "padding-left: 10px;font-family:arial">
			<p><u>Installation Instructions - Windows Desktop Application</u><br /><br />
			1. If you haven't already, click on the app link.<br /><br />
			2. Unzip the download contents.<br /><br />
			3. Navigate into the folder and run the 'setup.exe' file. <br /><br />
			4. When prompted press install, the app will automatically open when installation is complete.<br /><br />
			5. Congratulations, you can now start logging data :) </p>

			<div style= padding-top:10px; >
				<form action=https://projectgonzocoventry.000webhostapp.com/downloads/MSAPP.zip>
					<input type="submit" value="Desktop App Download Button" />
				</form>
				<br>
			</div>
			<div style = "font-family:arial">
				<p><u>Installation Instructions - Android Mobile Application</u><br><br>
				1. Open this download page on your Android device.<br><br>
				2. Click on the download button for the Android app.<br><br>
				3. Open the downloaded file and press on the ‘mobile-app.apk’ file and choose install from the options that appear. The app will now be installed to your device.<br><br>
				4. Find the ‘Project Gonzo’ app under your downloaded apps and open it.<br><br>
				5. Press the grey button at the top of the screen, this will start sending data every hour. And now youre all sorted!<br><br>
			</div>
			<div style = padding-top:10px;>
				<form action=https://projectgonzocoventry.000webhostapp.com/downloads/MobileApp.zip>
					<input type="submit" value="Mobile App Download Button" />
				</form>
			</div>
		</div>

	</body>
</html>

