<?php
  session_start();
  
  include("../functions/generalFunctions.php");
  
  if(!isset($_SESSION['Username'])){
	  header("Location: login.php");
	  die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
    <link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
    <link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
    <title>Home | Project Gonzo</title>
  </head>
  <body>
    <div id="Page">
      <div id="Header">
		<div id="Menu">
			<?php displayMainMenu(); ?>
		</div>
      </div>
      
      <div id="Content">
		  <h1 style="font-family:arial">Project Gonzo</h1>
	<p style="font-family:arial">Welcome <?php echo $_SESSION['Username']; ?>, to the Project Gonzo homepage.
	</p>
		<div id="Content">
			
	<p style="font-family:arial"><img src="../img/gonzoLogo.jpg" alt="Gonzo Logo" align="right" align="bottom" class="res"/>
			Project Gonzo is a data collection tool that retrieves information for the
			battery level, charging state and CPU usage from a Windows machine and the battery level and charging state from an Android device.
	</p>
			
	<p style="font-family:arial">If the application hasn't been installed already, your administrator can install the application on 
			your device by navigating to the downloads page.
	</p>
		
	<p style="font-family:arial">To access historical data and produce charts please select either 'My Device' or 'Charts', 
	dependant on your permission level.
	</p>
			
	<img src="../img/AndroidPhoneUpdated.png" align="top" alt="Android Phone" class="res"/>
      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
