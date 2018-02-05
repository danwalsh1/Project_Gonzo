<?php
  session_start();
  
  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");
  include("../functions/chartFunctions.php");
  
  if(!isset($_SESSION['Username'])){
	  header("Location: login.php");
	  die();
  }
  
  $userValues = get_users_values($_SESSION['Username']);
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
		<h2>Device ID: <?php echo $userValues->device_id; ?></h2>
		<?php
			$result = get_avg_device_data_dates('2018-02-04', 7, 'lapTest');

			$count = 0;
			$dataString = "[['Date', 'Avg Battery Level'],";
			while($count < 6){
				$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "],";
				$count += 1;
			}
			$dataString = $dataString . "['" . $result[1][$count] . "', " . $result[0][$count] . "]]";
			
			#echo $dataString;
			makeGoogleChart('Data Chart', 500, 300, 'dataChart', $dataString);
		?>
		
		<div id="dataChart"></div>
      </div>
      
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
