<?php
	function displayMainMenu(){
		echo '<label for="main-menu-control" class="main-menu-control">&#9776;</label>';
		echo '<input type="checkbox" id="main-menu-control" role="button">';
		echo '<div id="main-menu"><nav><ul>';
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin'] == true){
				echo '<li><a href="home.php">Home</a></li>
				<li><a href="adminCharts.php">Sensor Data</a></li>
				<li><a href="AdminPage.php">Administration</a></li>
				<li><a href="createUser.php">Create User</a></li>
				<li><a href="Downloads.php">Downloads</a></li>
				<li><a href="logout.php">Logout</a></li>
				<li style="float:right"><a href="home.php"><img src="../img/gonzoLogo.jpg" height="60" width="65" style="align:center" /></a></li>';
			}else{
				echo '<li><a href="home.php">Home</a></li>
				<li><a href="userCharts.php">My Device</a></li>
				<li><a href="UserProfile.php">My Profile</a></li>
				<li><a href="logout.php">Logout</a></li>
				<li style="float:right"><a href="home.php"><img src="../img/gonzoLogo.jpg" height="60" width="65" style="align:center" /></a></li>';
			}
		}else{
			echo '<li><a href="login.php">Login</a></li><li style="float:right"><a href="home.php"><img src="../img/gonzoLogo.jpg" height="60" width="65" style="align:center" /></a></li>';
		}
		echo '</ul></nav></div>';
	}
	
	function retrieve_users_DropDown(){
	$connect = connect_db("NULL");
	$sql = "SELECT * FROM users";
	$result = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($result))
	{
		echo $ListofNames="<option>" . $row['username'] . "</option>";

	}
	}
?>
