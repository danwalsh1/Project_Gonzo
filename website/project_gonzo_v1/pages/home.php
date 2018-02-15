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
    <link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
    <link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
    <title>Home | Project Gonzo</title>
  </head>
  <body>
    <div id="Page">
      <div id="Header">
	  <h1>Project Gonzo<h1>
		<div id="Menu">
			<nav>
				<ul>
					<?php displayMainMenu(); ?>
				</ul>
			</nav>
		</div>
      </div>
      
      <div id="Content">
		<img src="../img/gonzoLogo.jpg" />
		<p>Welcome <?php echo $_SESSION['Username']; ?>, to the Project Gonzo homepage</p>
		 <div id="Content">
	  
		<p>Project Gonzo is a app which you download on your device, 
			it records your device's sensor data for example; battery 
			percentage, CPU usage, brightness, temperature, location and 
			rotation.<p>
		<p>Step 1: Create a free account - To start you off with Project Gonzo 
		    Our website takes your phone data seriously which is why we are
			asking every user to create an account with a Username and
			password. this ensures that only you can see your device data.<p> 
		<p>Step 2: Install the App through our Website - you must then install 
		    the app on the device you wish to monitor. This can be done by
			accessing the website on your device and clicking the download
			button on the top left of the screen.<p>
		<p>Step 3: Run the App - Once you have downloaded the app, open it
			and click run which is at the center of the screen. This will
			then start the recording of your device's censor data, the app
			runs in the background and sends the informations collected to
			the websites database where it gets stored.<p>
		<p>Step 4: Now all you do is leave it - censor data will be recorded
			every 10 minutes the data recorded can then be viewed anytime 
			on our website only through your account.<p> 
		<img src="../img/Androidphone.png" alt="Android Phone"/>
      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>

