<?php
  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php"); #Import additional functionality stored in seperate files.
  include("../functions/sqlFunctions.php");
  
check_db_exists();  
	
if (isset($_POST['SubmitProfileForm'])){ #Checks to make sure the $_POST form value exists before processing the function call assigned to the variable.
	$result = update_user_data();
	}

function fetch_user_data($username){
		$connect = connect_db("NULL"); #NULL as no data retrieval is required yet, simply the connection.
		$sql = 'SELECT * FROM users WHERE username = ?'; #Queries the database for the users details using details stored in session.
		$stmt = $connect->prepare($sql);
		$stmt->bind_param('s', $username);
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
			
}
?>

<!DOCTYPE html>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Makes page mobile-friendly-->
      <link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
      <link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
      <title>User Profile | Project Gonzo</title> <!--Page title -->
  </head>
  <body>
    <div id="Page">
      <div id="Header">
		<div id="Menu">
			<?php displayMainMenu(); ?>
		</div>
      </div>
	  
	 
      <div style ="text-align: center;"> <!--Form Configuration and positioning -->
	  <form method ="POST" action="UserProfile.php">
	  
	   <div id="Username" style="padding-top: 10px; font-family:arial">
		<label> Username: </label>
		<input type ="text" name="username" value=<?php echo fetch_user_data($_SESSION['Username'])[0]  ?>>   
	   </div>
	  <!--As for all the values in the form, the variable $value defined earlier is used to map to each table value to the form field name.-->
       <div id="FirstNameText" style="padding-top: 10px; font-family:arial">
		<label> First Name: </label>
		<input type ="text" name="forename" value=<?php echo fetch_user_data($_SESSION['Username'])[1] ?>>
	   </div>
		
	   <div id="Surname" style="padding-top: 10px;font-family:arial">
		<label> Surname: </label>
		<input type="text" name ="surname" value=<?php echo fetch_user_data($_SESSION['Username'])[2] ?>>
	   </div>
		
		<div id= "Device_ID" style="padding-top: 10px;font-family:arial">
		 <label> Device ID: </label>
		 <input type ="text" name="deviceid" value=<?php echo fetch_user_data($_SESSION['Username'])[3] ?>>
		</div>
		 
		
		<div id= "Phone_Number" style="padding-top: 10px;font-family:arial">
		 <label> Phone Number: </label>
		 <input type ="text" name="phonenum" value=<?php echo fetch_user_data($_SESSION['Username'])[4] ?>>
		</div>
		
		<div id= "Email_Address" style="padding-top: 10px;font-family:arial">
		 <label> Email Address: </label>
		 <input type ="text" name="email" value=<?php echo fetch_user_data($_SESSION['Username'])[5] ?>>
		</div>
		
		
		<div id= "Update_Password" style="padding-top: 10px;font-family:arial">
		 <label> Update Password: </label>
		 <input type ="password" name="PasswordUpdate" value=<?php echo fetch_user_data($_SESSION['Username'])[6] ?>>
		</div> 
		

		<div style="padding-top: 10px;padding-left: 50px; font-family:arial">
		  <input type="submit" value="Save" name="SubmitProfileForm">
		</div>
	   </div>
	  </form>
      </div>
	  
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
