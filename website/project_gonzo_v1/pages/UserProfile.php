<?php
  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");
   

function fetch_user_data($username){
		$connect = connect_db("NULL");
		$sql = '"SELECT * FROM users WHERE username="'. $_SESSION["Username"];
		$result = mysqli_query($connect, $sql);
		$value = mysqli_fetch_object($result);
		
		}
		

function submit_user_data(){
        $connect = connect_db("NULL");
        $sql = 'UPDATE users (username, forename, surname, device_ID, phone_num, email) VALUES' .               $_POST['username'],$_POST['forename'],$_POST['surname'],$_POST['deviceid'],$_POST['phonenum'], $_POST['email'];
        
        $result = mysqli_query($connect, $sql);
        $value = mysqli_

?>


<!DOCTYPE html>
<html>
  <head>
  <link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
  <link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
    <title>User Profile | Project Gonzo</title> <!--Project title -->
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
	  
	 
      <div style ="text-align: center;"> <!--Form Configuration and positioning -->
	  <form method ="POST" action="login.php">
	  
	   <div id="Username" style="padding-top: 10px;">
		<label> First Name: </label>
		<input type ="text" name="username" value=<?php echo '"' . $value->username . '"' ?>>
	   </div>
	  
       <div id="FirstNameText" style="padding-top: 10px;">
		<label> First Name: </label>
		<input type ="text" name="forename" value=<?php echo '"' . $value->forename . '"' ?>>
	   </div>
		
	   <div id="Surname" style="padding-top: 10px;">
		<label> Surname: </label>
		<input type="text" name ="surname" value=<?php echo '"' . $value->surname . '"' ?>>
	   </div>
		
		<div id= "Device_ID" style="padding-top: 10px;">
		 <label> Device ID: </label>
		 <input type ="text" name="deviceid" value=<?php echo '"' . $value->device_id . '"' ?>>
		</div>
		 
		
		<div id= "Phone_Number" style="padding-top: 10px;">
		 <label> Phone Number: </label>
		 <input type ="text" name="phonenum" value=<?php echo '"' . $value->phone_num . '"' ?>>
		</div>
		
		<div id= "Email_Address" style="padding-top: 10px;">
		 <label> Email Address: </label>
		 <input type ="text" name="email" value=<?php echo '"' . $value->email . '"' ?>>
		</div>

		<div style="padding-top: 10px;padding-left: 50px;">
		  <input type="submit" value="Submit" name ="SubmitProfileForm">
		</div>
	   </div>
	  </form>
      </div>
	  
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
