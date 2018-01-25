<?php
	function displayMainMenu(){
		if(isset($_SESSION['useradmin'])){
			if($_SESSION['useradmin'] == true){
				echo '<li><a href="home.php">Home</a></li><li><a href="logout.php">Logout</a></li>';
			}else{
				echo '<li><a href="home.php">Home</a></li><li><a href="logout.php">Logout</a></li>';
			}
		}else{
			echo '<li><a href="login.php">Login</a></li>';
		}
	}
?>