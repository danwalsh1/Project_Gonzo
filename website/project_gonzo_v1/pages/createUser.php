<?php
	session_start(); #Starts a session.
  
	include("../functions/generalFunctions.php"); #Import additional functionality stored in seperate files.
	include("../functions/sqlFunctions.php");

	if(isset($_SESSION['Username']) == false){
		header("Location: login.php");
		die();
	}

	if(isset($_SESSION['admin'])){
		if($_SESSION['admin'] == False){
			header("Location: home.php");
			die();
		}
	}else{
		header("Location: logout.php");
		die();
	}
  
	if(isset($_POST['createUser'])){
		if(ctype_alnum($_POST['username']) and ctype_alnum($_POST['forename']) and ctype_alnum($_POST['surname']) and ctype_alnum($_POST['deviceid']) and ctype_alnum($_POST['phonenumber']) and ctype_alnum($_POST['password']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			if(isset($_POST['admin'])){
				if($_POST['admin'] == true){
					$admin = 1;
				}else{
					$admin = 0;
				}
			}else{
				$admin = 0;
			}
			$connect = connect_db();   # Connects to data base
			$sql = "INSERT INTO users(username, password, admin, forename, surname, device_id, phone_num, email) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";   # Queries the data base for user details 
			$stmt = $connect->prepare($sql);
			$stmt->bind_param('ssisssss', $_POST['username'], $_POST['password'], $admin, $_POST['forename'], $_POST['surname'], $_POST['deviceid'], $_POST['phonenumber'], $_POST['email']);
			$stmt->execute();
	  
			$msg = "New user created with the username: " . $_POST['username'];
			messages($msg, "createUser.php", 10);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
		<title>Create User | Project Gonzo</title> <!--Page title -->
	</head>
	<body>
		<div id="Page">
			<div id="Header">
				<div id="Menu">
					<?php displayMainMenu(); ?>
				</div>
			</div>
	    
			<div id="Content">
				<div id="createUserForm" style="font-family:arial">
					<table align="center">
						<form action="createUser.php" method="POST">
							<tr>
								<td>
									<label>Username:</label>
								</td>
								<td>
									<input type ="text" name="username">   
								</td>
							</tr>
			
							<tr>
								<td>
									<label>Forename:</label>
								</td>
								<td>
									<input type ="text" name="forename">
								</td>
							</tr>
		
							<tr>
								<td>
									<label>Surname:</label>
								</td>
								<td>
									<input type="text" name ="surname">
								</td>
							</tr>
		
							<tr>
								<td>
									<label>Device ID:</label>
								</td>
								<td>
									<input type ="text" name="deviceid">
								</td>
							</tr>
		 
							<tr>
								<td>
									<label>Phone Number:</label>
								</td>
								<td>
									<input type ="text" name="phonenumber">
								</td>
							</tr>
		
							<tr>
								<td>
									<label>Email Address:</label>
								</td>
								<td>
									<input type ="text" name="email">
								</td>
							</tr>
		
							<tr>
								<td>
									<label>Password:</label>
								</td>
								<td>
									<input type ="text" name="password">
								</td>
							</tr>
				
							<tr>
								<td>
									<label>Admin:</label>
								</td>
								<td>
									<input type="checkbox" name="admin">
								</td>
							</tr>
			
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Create User" name="createUser">
								</td>
							</tr>
						</form>
					</table>
				</div>
			</div>
	  
			<div id="Footer">
			</div>
		</div>
	</body>
</html>
