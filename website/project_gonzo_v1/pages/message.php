<?php
  session_start();
  
  include("../functions/generalFunctions.php");
  
  if(!isset($_SESSION['Username'])){
	  header("Location: login.php");
	  die();
  }
  
  if(isset($_SESSION['msg']) and isset($_SESSION['redir']) and isset($_SESSION['time'])){
	  $msg_data = $_SESSION['msg'];
	  $redir_data = $_SESSION['redir'];
	  $time_data = $_SESSION['time'];
	  unset($_SESSION['msg']);
	  unset($_SESSION['redir']);
	  unset($_SESSION['time']);
  }else{
	  header("Location:home.php");
  }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
		<title></title>
	</head>
	<body>
		<div id="page">
			<div id="header">
				<div id="Menu">
					<?php displayMainMenu(); ?>
				</div>
			</div>
			<div id="content" style="font-family: arial">
				<p>
					<?php
						echo $msg_data;
					?>
				</p>
				
				<script type="text/javascript">
					(function(){
						//timer
						var time = <?php echo $time_data; ?>, tInterval;
						
						var tCountdown = function(){
							time--;
							document.getElementById('timeLeft').innerHTML = time;
							if(time == 0){
								clearInterval(tInterval);
								window.location = "<?php echo $redir_data ?>";
							}								
						};
						
						tInterval = setInterval(tCountdown, 1000);
					}
					)();
				</script>
				<p>
					You will be redirected in... <span id="timeLeft"><?php echo $time_data ?></span> seconds.
				</p>
				<p>
					or redirect now through clicking the button below:
				</p>
				<button onclick="location.href='<?php echo $redir_data ?>'" type="button">Redirect Now</button>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>