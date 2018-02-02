<?php
  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");
  
  check_db_exists();
  
  if (isset($_POST['logindone'])){# checks credentials are valid and then passes through to homepage.
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
	$values = mysqli_fetch_object($result);
	if($values->admin == True){  # Check if the user is an admin and store in the session dictionary.
		$_SESSION['admin'] = True;
	}else{
		$_SESSION['admin'] = False;
	}
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
    <title>Login | Project Gonzo</title> <!--Project title -->
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
		<label> Username: </label>
		<input type ="text" name="Username">
		</div>
	   <div id="PasswordText" style="padding-top: 10px;">
		<label> Password: </label>
		<input type="password" name ="Password">
		<div style="padding-top: 10px;padding-left: 50px;">
		<input type="submit" value="Login" name ="logindone">
		</div>
	   </div>
	  </form>
      </div>
	  
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
