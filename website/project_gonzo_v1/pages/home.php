<?php
	session_start();
	include("../functions/generalFunctions.php"); #Allows functionality from the 'generalFunctions.php' page.

	if(!isset($_SESSION['Username'])){            #If the current session does not have a username set to it then the user will be taken to the login.php page.
		header("Location: login.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">        <!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />       <!--Gets the css for this page from the 'mainMenu.css' and 'mainLayout.css' files-->
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
		<title>Home | Project Gonzo</title>                                           <!--Project title -->
	</head>
	<body>
		<div id="Page">
			<div id="Header">
				<div id="Menu">
					<?php displayMainMenu(); ?>                                             <!--Calls the displayMainMenu function to show the main menu at the top of the page.-->
				</div>
			</div>
			<div id="Content">																													<!--Opens a new div for Header1 and the welcome message.-->
				<h1 style="font-family:arial">Project Gonzo</h1>
					<p style="font-family:arial">Welcome <?php echo $_SESSION['Username']; ?>, to the Project Gonzo homepage.</p>			 					<!--The php echo code here allows the text to be personalised to the user, so the site welcomes them by their username-->
				<div id="Content">																																																	 					<!--Opens the Content div again, seperating the Header1 and welcome message from the text below.-->
					<p style="font-family:arial"><img src="../img/gonzoLogo.jpg" alt="Gonzo Logo" align="right" align="bottom" class="res"/>		<!--Allows the image from the given folder to be used on the website, on the right at the bottom of the div.-->
					Project Gonzo is a data collection tool that retrieves information for the
					battery level, charging state and CPU usage from a Windows machine and the battery level and charging state from an Android device.</p>
					<p style="font-family:arial">If the application hasn't been installed already, your administrator can install the application on
					your device by navigating to the downloads page.</p>
					<p style="font-family:arial">To access historical data and produce charts please select either 'My Device' or 'Charts',
					dependant on your permission level.</p>
					<img src="../img/AndroidPhoneUpdated.png" align="top" alt="Android Phone" class="res"/> 																		<!-- Allows the image from the given folder to be used on the website as high as possible after the text.-->
				</div>

				<div id="Footer">
				</div>
			</div>
	</body>
</html>
