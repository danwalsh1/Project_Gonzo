<?php
  session_start();

  include("../functions/generalFunctions.php");

  if(!isset($_SESSION['Username'])){
	  header("Location: login.php");
	  die();
  }

?>
<style>
* {padding: 0; margin: 0;}
#TextFields
{
  width:300px;
  height:auto;
  text-align: center;
}
</style>

<!DOCTYPE html>
<html>
  <head>
    <link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
    <link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
    <title>Admin Page | Project Gonzo</title>
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
    <br>
	  <form action="/action_page.php">
      Select Username:
	    <input list="browsers" name="browser">
		<datalist id="browsers">				<!-- Below should be changed to fit the needs of our data using PHP. -->
		  <option value="THIS ISNT DONE YET">
		  <option value="Daniel Walsh">
		  <option value="Gareth Holloway">
		  <option value="Elliot Hawkins">
		  <option value="Jacob Stenson">
		</datalist>

		<input type="submit">
		</form>

    <br>
<div id="TextFields">

  <form action="action_page.php">              <!-- Below should be changed to fit the needs of our data using PHP. -->
  Username:
  <input name="Username" type="text" value="Username here.">
  <br>
  Password:
  <input name="Password" type="text" value="Password here.">
  <br>
  <br>
  Forename:
  <input name="Forename" type="text" value="Forename here.">
  <br>
  Surname:
  <input name="Surname" type="text" value="Surname here.">
  <br>
  Device_ID:
  <input name="Device_ID" type="text" value="Device_ID here.">
  <br>
  Phone Number:
  <input name="Phone_Num" type="text" value="Phone Number here.">
  <br>
  Email:
  <input name="Email" type="text" value="Email here.">
  <br><br>
  <input type="submit">
</form>
</div>



</body>
</html>
      </div>
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
