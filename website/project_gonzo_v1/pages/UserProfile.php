<?php
  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");
   
  if (isset($_POST['submit'])){# checks credentials are valid and then passes through to homepage.
	$result = UserLogin($_POST['Username'],$_POST['Password']); #Stores input username and password.
	if($result){ #if result is true, continues through to homepage otherwise remains on login page.
		$_SESSION["Username"] = $_POST['Username']; #Post assigned to session to carry username to next page.
		header ("Location: home.php");
		die();
	}
  }
  
function UserLogin($username,$password){ #Passes in username and password from html form.
$connect = connect_db(); #connect to db
$sql = 'SELECT * FROM users WHERE username="' . $username . '" AND password="' . $password . '"'; # checking validity of credentials.
$result = mysqli_query($connect,$sql); #Executed query stored in $result.
if(mysqli_num_rows($result)== 1){ #Conditions checked, passes over to $result in the start if statement.
	return true;
	}
else{
	return false;
	}
}
	
?>
<!DOCTYPE html>
<html>
  <head>
  <link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
  <link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
    <title>Logout | Project Gonzo</title> <!--Project title -->
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
	  
       <div id="UsernameText" style="padding-top: 10px;">
		<label> First Name: </label>
		<input type ="text" name="First Name">
	   </div>
		
	   <div id="Surname" style="padding-top: 10px;">
		<label> Surname: </label>
		<input type="text" name ="Surname">
	   </div>
		
		<div id= "Device_ID" style="padding-top: 10px;">
		 <label> Device ID: </label>
		 <input type ="text" name="DeviceID">
		</div>
		 
		
		<div id= "Phone_Number" style="padding-top: 10px;">
		 <label> Phone Number: </label>
		 <input type ="text" name="Phone Number">
		</div>
		
		<div id= "Email_Address" style="padding-top: 10px;">
		 <label> Email Address: </label>
		 <input type ="text" name="Email Address">
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
