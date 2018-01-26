<?php
  session_start();
  
  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");
  
  check_db_exists();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login | Project Gonzo</title>
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
