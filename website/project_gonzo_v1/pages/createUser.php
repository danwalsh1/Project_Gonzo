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
		<div id="createUserForm" style="text-align: center;font-family:arial">
			<form action="createUser.php" method="POST">
				<div id="Username" style="padding-top: 10px;">
					<label>Username:</label>
					<input type ="text" name="username">   
				</div>
			
				<div id="Forename" style="padding-top: 10px;font-family:arial">
					<label>Forename:</label>
					<input type ="text" name="forename">
				</div>
		
				<div id="Surname" style="padding-top: 10px;font-family:arial">
					<label>Surname:</label>
					<input type="text" name ="surname">
				</div>
		
				<div id= "Device_ID" style="padding-top: 10px;font-family:arial">
					<label>Device ID:</label>
					<input type ="text" name="deviceid">
				</div>
		 
				<div id= "Phone_Number" style="padding-top: 10px;font-family:arial">
					<label>Phone Number:</label>
					<input type ="text" name="phonenumber">
				</div>
		
				<div id= "Email_Address" style="padding-top: 10px;font-family:arial">
					<label>Email Address:</label>
					<input type ="text" name="email">
				</div>
		
				<div id= "Password" style="padding-top: 10px;font-family:arial">
					<label>Password:</label>
					<input type ="text" name="password">
				</div>
				
				<div id="Admin" style="padding-top: 10px;font-family:arial">
					<label>Admin:</label>
					<input type="checkbox" name="admin">
				</div>
			
				<div id= "Submit" style="padding-top: 10px;font-family:arial">
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
