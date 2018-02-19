<?php

  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php");
  
?>

<!DOCTYPE html>
<html>
  <head>
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
	  
	<div style= padding-top:10px; >
	<a href=https://projectgonzocoventry.000webhostapp.com/downloads/MSAPP.zip > Click here for the desktop app. </a>
	</div>
	</body>
</html>
