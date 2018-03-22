<?php
	session_start();
  
	include("../functions/generalFunctions.php"); #Allows access to external functionality.

	if(isset($_SESSION['Username'])){ #If the username is present in the session.
		unset($_SESSION['Username']); #Removes the username from the session.
	}
	if(isset($_SESSION['admin'])){ #If admin is present in the session. 
		unset($_SESSION['admin']); #Remove the admin from the session.
	}
	session_destroy(); #Destroys the session that's started at the beginning.
	Header("Location: login.php"); #Redirects to login.php page.
	die(); #Stops the script running any further.
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Logout | Project Gonzo</title>
	</head>
	<body>
		<div id="Page">
			<div id="Header">
				<div id="Menu">
					<?php displayMainMenu(); ?>
				</div>
			</div>
      
			<div id="Content">
			</div>
      
			<div id="Footer">
			</div>
		</div>
	</body>
</html>
