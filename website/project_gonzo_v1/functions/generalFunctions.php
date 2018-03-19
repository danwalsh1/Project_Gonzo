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
		$connect = connect_db(); #Connects to DB.
		$sql = "SELECT * FROM users"; #SQL statement.
		$result = mysqli_query($connect, $sql); #Run the query and store in result.
		while($row = mysqli_fetch_array($result)){#While values in result, display them as an option in the dropdown.
			echo $ListofNames="<option>" . $row['username'] . "</option>"; #Displays values to the screen in the dropdown box.
		}
	}
		
	function messages($message, $redirect, $time){		# We have the variables of message, redirect and time.
		if(gettype($message) == "string" and gettype($redirect) == "string" and gettype($time) == "integer"){	# If these variable from have correct inputs types
			$_SESSION['msg'] = $message;		# message is passed as the same value of msg in message.php
			$_SESSION['redir'] = $redirect;		# and the same is done to the others.
			$_SESSION['time'] = $time;		
			header("Location: message.php");	# The user is then redirected to the message page
		}
	}
				
?>

