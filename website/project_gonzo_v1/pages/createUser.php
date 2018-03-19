<?php
	session_start(); #Starts a session.
  
	include("../functions/generalFunctions.php"); #Import additional functionality stored in seperate files.
	include("../functions/sqlFunctions.php");

	if(isset($_SESSION['Username']) == false){ #Checks if the username is not set in the session and then destroys the login page. 
		header("Location: login.php");
		die(); #Stops php code from login.php running.
	}

	if(isset($_SESSION['admin'])){ #Checks if admin is set in session and if it is, destroys the home.php page to prevent pages.
		if($_SESSION['admin'] == False){
			header("Location: home.php");
			die(); #Stops php code from home.php running.
		}
	}else{
		header("Location: logout.php"); #If no conditions met, destory the logout page.
		die(); #Stops php code from logout.php from running.
	}
  
	if(isset($_POST['createUser'])){
		if(ctype_alnum($_POST['username']) and ctype_alnum($_POST['forename']) and ctype_alnum($_POST['surname']) and ctype_alnum($_POST['deviceid']) and ctype_alnum($_POST['phonenumber']) and ctype_alnum($_POST['password']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			if(isset($_POST['admin'])){#Checks the types so email addresses can't ill formed. Make sure no special characters can be entered.
				if($_POST['admin'] == true){#Determines if the user created is an admin or not.
					$admin = 1;
				}else{
					$admin = 0;
				}
			}else{
				$admin = 0;
			}
			$connect = connect_db();   # Connects to data base
			$sql = "INSERT INTO users(username, password, admin, forename, surname, device_id, phone_num, email) VALUES(?, ?, ?, ?, ?, ?, ?, ?)"; #SQL statement with placeholders.
			$stmt = $connect->prepare($sql); #OpenDB connection and prepare the SQL statement.
			$stmt->bind_param('ssisssss', $_POST['username'], $_POST['password'], $admin, $_POST['forename'], $_POST['surname'], $_POST['deviceid'], $_POST['phonenumber'], $_POST['email']);#Placeholder types and values implemented in the order they are input.
			$stmt->execute();#Statement executed.
			$stmt->close(); #Connection closed.
	  
			$msg = "New user created with the username: " . $_POST['username']; #Message that is passed into the messages fucntions on the generalFunctions.php page.
			messages($msg, "createUser.php", 10); #Message passed in, page to return to stated, time until redirect.
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
