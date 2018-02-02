<?php
  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");

check_db_exists();  


	
if (isset($_POST['SubmitProfileForm'])){
	$result = update_user_data();
	}



function fetch_user_data($username){
		$connect = connect_db("NULL");
		$sql = 'SELECT * FROM users WHERE username="'. $_SESSION["Username"] . '"';
		$result = mysqli_query($connect, $sql);
		$value = mysqli_fetch_object($result);
		return $value;
		}
$value = fetch_user_data($_SESSION['Username']);
		
function update_user_data(){
        $connect = connect_db("NULL");
		{
        $sql = "UPDATE users SET forename='" . $_POST['forename'] . "', surname='" . $_POST['surname'] . "', device_id='" . $_POST['deviceid'] . "', phone_num='" . $_POST['phonenum'] . "', email='" . $_POST['email'] . "'WHERE username='". $_POST['username'] . "'";
		}		
        $result = mysqli_query($connect, $sql);
		echo $sql;
}
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
	  <form method ="POST" action="UserProfile.php">
	  
	   <div id="Username" style="padding-top: 10px;">
		<label> Username: </label>
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
		
		<!--
		<<div id= "Update_Password" style="padding-top: 10px;">
		 <label> Update Password: </label>
		 <input type ="text" name="PasswordUpdate" value=<?php echo '"' . $value->password . '"' ?>>
		</div> 
		-->

		<div style="padding-top: 10px;padding-left: 50px;">
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
