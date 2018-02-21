<?php

  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php");
  
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
			<nav>
				<ul>
					<?php displayMainMenu(); ?>
				</ul>
			</nav>
		</div>
      </div>
	  
	<div style = "padding-left: 10px;">
	<p><u>Installation Instructions - Windows Desktop Application</u></p>
	<p>1. If you haven't already, click on the app link.</p>
	<p>2. Unzip the download contents.</p>
	<p>3. Navigate into the folder and run the 'setup.exe' file. </p>
	<p>4. When prompted press install, the app will automatically open when installation is complete.</p>
	<p>5. Congratulations, you can now start logging data :) </p>
	  
	<div style= padding-top:10px; >
	<a href=https://projectgonzocoventry.000webhostapp.com/downloads/MSAPP.zip > Click here for the desktop app. </a>
	</div>
	</body>
</html>
	
