<?php
	function displayMainMenu(){
		# This function is used to echo HTML code into a page. The HTML code creates the main menu that should be shown at the top of all pages.
		echo '<label for="main-menu-control" class="main-menu-control" style="font-size: 40px">&#9776;</label>';
		echo '<input type="checkbox" id="main-menu-control" role="button">';
		echo '<div id="main-menu"><nav><ul>';
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin'] == true){
				echo '<li><a href="home.php"; style="font-family:arial">Home</a></li>
				<li><a href="adminCharts.php"; style="font-family:arial">Charts</a></li>
				<li><a href="AdminPage.php"; style="font-family:arial">Administration</a></li>
				<li><a href="createUser.php"; style="font-family:arial">Create User</a></li>
				<li><a href="Downloads.php"; style="font-family:arial">Downloads</a></li>
				<li><a href="logout.php"; style="font-family:arial">Logout</a></li>
				<li style="float:right"><a href="home.php"><img src="../img/gonzoLogo.jpg" height="60" width="65" style="align:center" /></a></li>';
			}else{
				echo '<li><a href="home.php"; style="font-family:arial">Home</a></li>
				<li><a href="userCharts.php"; style="font-family:arial">My Device</a></li>
				<li><a href="UserProfile.php"; style="font-family:arial">My Profile</a></li>
				<li><a href="logout.php"; style="font-family:arial">Logout</a></li>
				<li style="float:right"><a href="home.php"><img src="../img/gonzoLogo.jpg" height="60" width="65" style="align:center" /></a></li>';
			}
		}else{
			echo '<li><a href="login.php"; style="font-family:arial">Login</a></li><li style="float:right"><a href="home.php"><img src="../img/gonzoLogo.jpg" height="60" width="65" style="align:center" /></a></li>';
		}
		echo '</ul></nav></div>';
	}
	
	function retrieve_users_DropDown(){
		# This function echos all available users into the dropdown boxes.
		$connect = connect_db("NULL");
		$sql = "SELECT * FROM users";
		$result = mysqli_query($connect, $sql);
		while($row = mysqli_fetch_array($result)){
			echo $ListofNames="<option>" . $row['username'] . "</option>";
		}
	}
		
	function messages($message, $redirect, $time){		# This is a function for the messages page
		if(gettype($message) == "string" and gettype($redirect) == "string" and gettype($time) == "integer"){	# This is stating that if message and redirect is a string and time is integer.
			$_SESSION['msg'] = $message;		# Message becomes the same value as msg from a related session
			$_SESSION['redir'] = $redirect;		# Redirect becomes redir.  
			$_SESSION['time'] = $time;		# Time becomes time from the message page.  
			header("Location: message.php");	# the user then get sent to the message page.
		}
	}
				
?>

