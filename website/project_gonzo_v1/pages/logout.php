<?php
  session_start();
  
  include("../functions/generalFunctions.php");
  if(isset($_SESSION['Username']){
	  unset($_SESSION['Username']);
  }
  if(isset($_SESSION['admin'])){
	  unset($_SESSION['admin']);
  }
  session_destroy();
  Header("Location: login.php");
  Die();
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
