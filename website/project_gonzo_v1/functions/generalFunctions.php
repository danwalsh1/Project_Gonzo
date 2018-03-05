<?php
	function displayMainMenu(){
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
				<li><a href="UserProfile.php; style="font-family:arial"">My Profile</a></li>
				<li><a href="logout.php"; style="font-family:arial">Logout</a></li>
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

