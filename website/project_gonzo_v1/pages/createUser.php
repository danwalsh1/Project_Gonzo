<?php
  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php"); #Import additional functionality stored in seperate files.
  include("../functions/sqlFunctions.php");

  if(isset($_SESSION['Username']) == false or $_SESSION['admin'] == false){
	  header("Location: login.php");
	  die();
  }
  
  if(isset($_POST['createUser'])){
	  if(ctype_alnum($_POST['username']) and ctype_alnum($_POST['forename']) and ctype_alnum($_POST['surname']) and ctype_alnum($_POST['deviceid']) and ctype_alnum($_POST['phonenumber']) and ctype_alnum($_POST['password']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		if($_POST['admin'] == true){
			$admin = "true";
		}else{
			$admin = "false";
		}
		  
		  $connect = connect_db();
		  $sql = "INSERT INTO users(username, password, admin, forename, surname, device_id, phone_num, email) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] . "', " . $admin . ", '" . $_POST['forename'] . "', '" . $_POST['surname'] . "', '" . $_POST['deviceid'] . "', '" . $_POST['phonenumber'] . "', '" . $_POST['email'] . "')";
		  
		  $result = mysqli_query($connect, $sql);
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
			<nav>
				<ul>
					<?php displayMainMenu(); ?>
				</ul>
			</nav>
		</div>
      </div>
	    
      <div id="Content">
		<div id="createUserForm" style="text-align: center;">
			<form action="createUser.php" method="POST">
				<div id="Username" style="padding-top: 10px;">
					<label>Username:</label>
					<input type ="text" name="username">   
				</div>
			
				<div id="Forename" style="padding-top: 10px;">
					<label>Forename:</label>
					<input type ="text" name="forename">
				</div>
		
				<div id="Surname" style="padding-top: 10px;">
					<label>Surname:</label>
					<input type="text" name ="surname">
				</div>
		
				<div id= "Device_ID" style="padding-top: 10px;">
					<label>Device ID:</label>
					<input type ="text" name="deviceid">
				</div>
		 
				<div id= "Phone_Number" style="padding-top: 10px;">
					<label>Phone Number:</label>
					<input type ="text" name="phonenumber">
				</div>
		
				<div id= "Email_Address" style="padding-top: 10px;">
					<label>Email Address:</label>
					<input type ="text" name="email">
				</div>
		
				<div id= "Password" style="padding-top: 10px;">
					<label>Password:</label>
					<input type ="text" name="password">
				</div>
				
				<div id="Admin" style="padding-top: 10px;">
					<label>Admin:</label>
					<input type="checkbox" name="admin">
				</div>
			
				<div id= "Submit" style="padding-top: 10px;">
					<input type="submit" value="Create User" name="createUser">
				</div>
			</form>
		</div>
	  </div>
	  
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
