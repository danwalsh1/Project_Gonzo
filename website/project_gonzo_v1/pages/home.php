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
			<nav>
				<ul>
					<?php displayMainMenu(); ?>
				</ul>
			</nav>
		</div>
      </div>
      
      <div id="Content">
	  <h1>Project Gonzo</h1>
		<p>Welcome <?php echo $_SESSION['Username']; ?>, to the Project Gonzo homepage</p>
		 <div id="Content">
		 <style>
		 p {
			 font-family: "arial";
			 font-size: 100%;
		 }	 
		 </style>
		<p><img src="../img/gonzoLogo.jpg" alt="Gonzo Logo" align="right" align="bottom" class="res"/>
			Project Gonzo is an App which you can download on your device, 
			it records your device's sensor data for example; battery 
			percentage, CPU usage, brightness, temperature, location and
			rotation.</p>
		<p><b>Step 1: Create a free account</b> - To start you off with Project Gonzo 
		    Our website takes your phone data seriously which is why we are
			asking every user to create an account with an Username and
			password. this ensures that only you can see your device data.</p> 
		<p><b>Step 2: Install the App through our Website</b> - you must then install 
		    the App on the device you wish to monitor. This can be done by
			accessing the website on your device and clicking the download
			button on the top left of the screen.</p>
		<p><b>Step 3: Run the App</b> - Once you have downloaded the App, open it
			and click run which is at the center of the screen. This will
			then start the recording of your device's censor data, the App
			runs in the background and sends the informations collected to
			the websites database where it gets stored.</p>
		<p><b>Step 4: Now all you do is leave it</b> - censor data will be recorded
			every 10 minutes the data recorded can then be viewed anytime 
			on our website only through your account.</p> 
		<img src="../img/Androidphone.png" align="top" alt="Android Phone" class="res"/>
      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
