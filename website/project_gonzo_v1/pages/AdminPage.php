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
    <title>AdminPage | Project Gonzo</title>
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
	  <h1> Admin Page </h1>
	  <p> Hello </p>
	  <form action="/action_page.php">
	    <input list="browsers" name="browser">
		<datalist id="browsers">				<!-- Below should be changed to fit the needs of our data using PHP. -->
		  <option value="THIS ISNT DONE YET">
		  <option value="Internet Explorer">
		  <option value="Firefox">
		  <option value="Chrome">
		  <option value="Opera">
		  <option value="Safari">
		</datalist>
		<input type="submit">
		</form>
</body>
</html>

      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
