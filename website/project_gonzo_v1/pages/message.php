<?php
	session_start();	# Start session
  
	include("../functions/generalFunctions.php");
  
	if(!isset($_SESSION['Username'])){	# If username is not set 
		header("Location: login.php");		# The user gets redirected to the login page 
		die();		# Function ends
	}
  
	if(isset($_SESSION['msg']) and isset($_SESSION['redir']) and isset($_SESSION['time'])){	 # If message and redirect and time are set 
		$msg_data = $_SESSION['msg'];		# data form another sesion is brought into this session and a variable is then created with these  
		$redir_data = $_SESSION['redir'];	
		$time_data = $_SESSION['time'];		
		unset($_SESSION['msg']);
		unset($_SESSION['redir']);
		unset($_SESSION['time']);		# Once they are all set to new names, they are then all unset.
	}else{
		header("Location:home.php");		# If not the user gets redirected to home. 
	}
?>
<!DOCTYPE html>		<!--Start of html code-->
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" /> <!--Gives the page the CSS with the main menu-->  
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" /> <!--Gives the page the main layout of the website--> 
		<title></title>
	</head>
	<body>
		<div id="page">
			<div id="header">
				<div id="Menu">
					<?php displayMainMenu(); ?> <!-- this calls a function in general functions which displays the main menu
				</div>
			</div>
			<div id="content" style="font-family: arial">	<!--creates a div for content which selects a font for the page.
				<p>
					<?php
						echo $msg_data;  // echo means to print in php, so this prints the message data which the user will read when enteringthe page.
					?>
				</p>
				
				<script type="text/javascript">
					(function(){		//timer
						var time = <?php echo $time_data; ?>, tInterval; // In php code the time data gets printed in 
												 // intervals every seconds
						var tCountdown = function(){			 // once this tCountdown is called the function will repeat 
							time--;					 // time - 1
							document.getElementById('timeLeft').innerHTML = time;	// this changes the timeleft new value to time - 1 and documents it. 
							if(time == 0){				 // if the time count hits zero
								clearInterval(tInterval);	 // the interval is cleared 
								window.location = "<?php echo $redir_data ?>";	// and the user if then redirected to the home page	
							}								
						};
						
						tInterval = setInterval(tCountdown, 1000);	// This means the countdown has 1000 millisecond intervals 
					}
					)();
				</script>
				<p>
					You will be redirected in... <span id="timeLeft"><?php echo $time_data ?></span> seconds.<!--The countdown is then printed with some text giving the user some context-->
				</p>
				<p>
					or redirect now through clicking the button below:		
				</p>
				<button onclick="location.href='<?php echo $redir_data ?>'" type="button">Redirect Now</button>	<!--link to the redirect link which sends the user back to the home-->
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>
