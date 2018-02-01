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
    <title>Charts | Project Gonzo</title>
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
      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
