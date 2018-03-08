<?php
  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php"); #Import additional functionality stored in seperate files.
  include("../functions/sqlFunctions.php");

  if(!isset($_SESSION['Username'])){ #Checks the session username is set from the login page and then kills off the login page after.
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
  
  
check_db_exists();  #Checks database existence by calling the function stored in sqlFunctions.php
	
if (isset($_POST['SubmitProfileForm'])){
		#If the data entry type is correct and equates to true, calls the update user data function.
	$result = update_user_data();
	}
	

if (isset($_POST['UpdateDetailsView'])){
	$UserSelected = $_POST['DD'];
		#Checked for validity incase of sql injection attempts.
	$result = fetch_user_data($UserSelected); #Runs the fetch function and displays in the form fields.
	}
		

function fetch_user_data($UserSelected){
		$connect = connect_db("NULL");
		$sql = 'SELECT * FROM users WHERE username = ?';
		$stmt = $connect->prepare($sql);
		$stmt->bind_param('s', $UserSelected);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
			
		return array($row['username'], $row['forename'], $row['surname'], $row['device_id'], $row['phone_num'], $row['email'],$row['password']);		
		}
			
		
function update_user_data(){
       		$connect = connect_db("NULL"); #Connects to DB
		$stmt = "UPDATE users SET forename = ?, surname = ?, device_id = ? , phone_num = ?, email = ?, password = ? WHERE username = ?";
        	$sql = $connect->prepare($stmt);
		$sql->bind_param('sssssss', $_POST['forename'], $_POST['surname'],$_POST['deviceid'], $_POST['phonenum'], $_POST['email'], $_POST['PasswordUpdate'], $_POST['username']);
		$sql->execute();
		$sql->close();
		
		$msg = "Users information has now been updated!";
		messages($msg, "AdminPage.php", 10);
		}
		
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
		<link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" /> <!--Calls CSS style sheets-->
		<link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
		<title>Admin Profile | Project Gonzo</title> <!--Page title -->
	</head>
	<body>
		<div id="Page">
			<div id="Header">
				<div id="Menu">
					<?php displayMainMenu(); ?>
				</div>
			</div>
	    
			<div style ="text-align: center;"> <!--Form Configuration and positioning -->
				<form method ="POST" action="AdminPage.php">	

					<div id="DropDown" style="padding-top: 10px; text-align: center; font-family:arial">
						<label> Please Select a User: </label>
						<select class="form-dropdown" style="width:150px" id="Dropdown" name="DD">
							<?php echo retrieve_users_DropDown(); ?>
						</select>
						<br>
					</div>

					<div style="padding-top: 10px;padding-left: 50px;font-family:arial">
						<input type="submit" value="Show User Details" name="UpdateDetailsView">	
					</div>
	  
					<div id="Username" style="padding-top: 10px;font-family:arial">
						<label> Username: </label>
						<input type ="text" name="username" value="<?php if(isset($UserSelected)){
															echo fetch_user_data($UserSelected)[0];
														} ?>">   <!--Updates the value based on whats passed in from the fetch_user_data function.-->
					</div>
	 	   
					<!--As for all the values in the form, the variable $value defined earlier is used to map to each table value to the form field name.-->
					<div id="FirstNameText" style="padding-top: 10px;font-family:arial">
						<label> First Name: </label>
						<input type ="text" name="forename" value="<?php if(isset($UserSelected)){
															echo fetch_user_data($UserSelected)[1];
														} ?>">
					</div>
		
					<div id="Surname" style="padding-top: 10px;font-family:arial">
						<label> Surname: </label>
						<input type="text" name ="surname" value="<?php if(isset($UserSelected)){
															echo fetch_user_data($UserSelected)[2];
														} ?>">
					</div>
		
					<div id= "Device_ID" style="padding-top: 10px;font-family:arial">
						<label> Device ID: </label>
						<input type ="text" name="deviceid" value="<?php if(isset($UserSelected)){
															echo fetch_user_data($UserSelected)[3];
														} ?>">
					</div>
		 
		
					<div id= "Phone_Number" style="padding-top: 10px; font-family:arial">
						<label> Phone Number: </label>
						<input type ="text" name="phonenum" value="<?php if(isset($UserSelected)){
															echo fetch_user_data($UserSelected)[4];
														} ?>">
					</div>
		
					<div id= "Email_Address" style="padding-top: 10px; font-family:arial">
						<label> Email Address: </label>
						<input type ="text" name="email" value="<?php if(isset($UserSelected)){
															echo fetch_user_data($UserSelected)[5];
														} ?>">
					</div>
		
		
					<div id= "Update_Password" style="padding-top: 10px; font-family:arial">
						<label> Update Password: </label>
						<input type ="password" name="PasswordUpdate" value="<?php if(isset($UserSelected)){
															echo fetch_user_data($UserSelected)[6];
														} ?>">
					</div> 
		

					<div style="padding-top: 10px;padding-left: 50px; font-family:arial">
						<input type="submit" value="Save" name="SubmitProfileForm">
					</div>
				</form>
			</div>
	  
			<div id="Footer">
			</div>
		</div>
	</body>
</html>
