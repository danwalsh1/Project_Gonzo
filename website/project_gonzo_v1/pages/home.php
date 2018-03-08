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
		  <h1>Project Gonzo</h1>
		<p>Welcome <?php echo $_SESSION['Username']; ?>, to the Project Gonzo homepage.</p>
		 <div id="Content">
		 <style>
		 p {
			 font-family: "arial";
			 font-size: 100%;
		 }	 
		 </style>
		<p><img src="../img/gonzoLogo.jpg" alt="Gonzo Logo" align="right" align="bottom" class="res"/>
			Project Gonzo is an app which you can download on to your device, 
			it records your device's sensor data, for example your battery 
			percentage, charging state and CPU usage.</p>
		<p><b>Step 1: Install the app through our Website -</b> you must first install 
		    the app on the device you wish to monitor. This can be done by
			accessing the website on your device and clicking the download
			button on the top left of the screen.</p>
		<p><b>Step 2: Run the app -</b> Once you have downloaded the app, open it
			and click run which is at the center of the screen. This will
			then start the recording of your device's censor data, the app
			runs in the background and sends the information collected to
			the websites database where it gets stored.</p>
		<p><b>Step 3: Now all you do is leave it -</b> censor data will be recorded
			every 10 minutes the data recorded can then be viewed anytime 
			on the <b>My device</b> page displayed as a graph.</p> 
		<img src="../img/AndroidPhoneUpdated.png" align="top" alt="Android Phone" class="res"/>
      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
