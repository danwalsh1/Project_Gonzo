<?php

	session_start(); #Starts a session.

	include("../functions/generalFunctions.php"); #Allows functionality from the 'generalFunctions.php' page.

	if(isset($_SESSION['Username']) == false){	#If the user tries to open this downloads.php page when they havent got a username yet they will be taken to the login page.
		header("Location: login.php");
		die();					#Stops the php script from being executed any further													#Kill the current page.
	}

	if(isset($_SESSION['admin'])){
		if($_SESSION['admin'] == False){					#If you are not an Admin and try to access the downloads.php page you will be redirected to the home.php page.
			header("Location: home.php");
			die();								#Stops the php script from being executed any further									#Kill the current page.
		}
	}else{ 																			#If admin is not in the session (for some reason it has not been defined) then the user will be taken to the logout page.
		header("Location: logout.php");
		die();									#Stops the php script from being executed any further									#Kill the current page.
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 							<!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />							<!--Gets the css for this page from the 'mainMenu.css' and 'mainLayout.css' files-->
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
		<title>Downloads | Project Gonzo</title> 																						<!--Project title -->
	</head>
	<body>
		<div id="Page">
			<div id="Header">
				<div id="Menu">
					<?php displayMainMenu(); ?>																										<!--Calls the displayMainMenu function to show the main menu at the top of the page.-->
				</div>
			</div>
		<div style = "padding-left: 10px;font-family:arial">
			<p><u>Installation Instructions - Windows Desktop Application</u><br /><br />			<!--All of the installation instructions for the windows app are written and coded into the website here.-->
			1. If you haven't already, click on the app link.<br /><br />
			2. Unzip the download contents.<br /><br />
			3. Navigate into the folder and run the 'setup.exe' file. <br /><br />
			4. When prompted press install, the app will automatically open when installation is complete.<br /><br />
			5. Congratulations, you can now start logging data :) </p>

			<div style= padding-top:10px; >
				<form action=https://projectgonzocoventry.000webhostapp.com/downloads/MSAPP.zip> <!--Creates a button on the website that can be clicked to download the windows app.-->
					<input type="submit" value="Desktop App Download" />
				</form>
				<br>
			</div>
			<div style = "font-family:arial">
				<p><u>Installation Instructions - Android Mobile Application</u><br><br> 				<!--All of the installation instructions for the mobile app are written and coded into the website here.-->
				1. Open this download page on your Android device.<br><br>
				2. Click on the download button for the Android app.<br><br>
				3. Open the downloaded file and press on the ‘mobile-app.apk’ file and choose install from the options that appear. The app will now be installed to your device.<br><br>
				4. Find the ‘Project Gonzo’ app under your downloaded apps and open it.<br><br>
				5. Press the grey button at the top of the screen, this will start sending data every hour. And now youre all sorted!<br><br>
			</div>
			<div style = padding-top:10px;>
				<form action=https://projectgonzocoventry.000webhostapp.com/downloads/MobileApp.zip> <!--Creates a button on the website that can be clicked to download the mobile app.-->
					<input type="submit" value="Mobile App Download" />
				</form>
			</div>
		</div>

	</body>
</html>
