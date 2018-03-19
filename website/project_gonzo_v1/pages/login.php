<?php
	session_start(); #Starts a session.
  
	include("../functions/generalFunctions.php"); #Allows additional functionality from the generalFunctions and sqlFunctions pages.
	include("../functions/sqlFunctions.php");
  
	if(isset($_SESSION['Username'])){ #Checks if a username is stored in session and then stops the php code running further.
		header("Location: home.php");
		die();
	}
	check_db_exists();
  
	if (isset($_POST['logindone'])){# checks credentials are valid and then passes through to homepage.
		if(ctype_alnum($_POST['Username']) AND ctype_alnum($_POST['Password'])){
			$result = UserLogin($_POST['Username'],$_POST['Password']); #Stores input username and password.
			if($result){ #if result is true, continues through to homepage otherwise remains on login page.
				$_SESSION["Username"] = $_POST['Username']; #Post assigned to session to carry username to next page.
				header ("Location: home.php");
				die(); #Stops the php code running any further.
			}
		}
	}
  
	function UserLogin($username,$password){ #Passes in username and password from html form.
		$connect = connect_db(); #connect to db
		$sql = 'SELECT * FROM users WHERE username = ? AND password = ?'; # checking validity of credentials. #SQL statement.
		$stmt = $connect->prepare($sql); #DB connection opened and SQL statement prepared.
		$stmt->bind_param('ss', $username, $password); #Placeholder types and values entered in order.
		$stmt->execute(); #Execute the statement.
		$result = $stmt->get_result();#Get the result of the statement.
		$row = $result->fetch_assoc();#Fetches all related values.
		if(mysqli_num_rows($result)== 1){
			if($row['admin'] == 1){  # Check if the user is an admin and store in the session dictionary.
				$_SESSION['admin'] = True;
			}else{
				$_SESSION['admin'] = False; #If false is returned, only show user level of access with less menus.
			}
			
			return true;
		}else{
			return false;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
		<title>Login | Project Gonzo</title> <!--Project title -->
	</head>
	<body>
		<div id="Page">
			<div id="Header">
				<div id="Menu">
					<?php displayMainMenu(); ?> <!--Pulls the navigation bar design-->
				</div>
			</div>
	  
			<div style="font-family:arial">
				<table align="center"> <!--Form Configuration and positioning -->
					<form method ="POST" action="login.php">
						<tr>
							<td>
								<label style="font-family:arial"> Username: </label>
							</td>
							<td>
								<input type ="text" name="Username">
							</td>
						</tr>
						<tr>
							<td>
								<label style="font-family:arial"> Password: </label>
							</td>
							<td>
								<input type="password" name ="Password">
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<input type="submit" value="Login" name ="logindone">
							</td>
						</tr>
					</form>
				</table>
			</div>
			
			<div id="Footer" style="font-family:arial; position:absolute; bottom:2%; padding-left:25%">
				<p>This website uses cookies; by continuing and using it's service you accept the use of these cookies.</p>
			</div>
		</div>
	</body>
</html>
