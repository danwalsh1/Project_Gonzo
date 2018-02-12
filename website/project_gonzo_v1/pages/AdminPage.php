<?php
  session_start(); #Starts a session.
  
  include("../functions/generalFunctions.php"); #Import additional functionality stored in seperate files.
  include("../functions/sqlFunctions.php");
  
check_db_exists();  
	
if (isset($_POST['SubmitProfileForm'])){ #Checks to make sure the $_POST form value exists before processing the function call assigned to the variable.
	$result = update_user_data();
	}

if (isset($_POST['UpdateDetailsView'])){
	$UserSelected = $_POST['DD'];
	$result = fetch_user_data($UserSelected);
	
	}	

function fetch_user_data($UserSelected){
		$connect = connect_db("NULL"); #NULL as no data retrieval is required yet, simply the connection.
		$sql = 'SELECT * FROM users WHERE username="' . $UserSelected . '"'; #Queries the database for the users details using details stored in session.
		$result = mysqli_query($connect, $sql); #Run the query.
		$value = mysqli_fetch_object($result);#Fetch the items identified in the $result variable.
		return $value; #return the fields identified.
		}
		
		{		
if(@$UserSelected == False){
$value = fetch_user_data($_SESSION['Username']);
}
else{
$value = fetch_user_data($UserSelected);
}
		}	
		
function update_user_data(){
        $connect = connect_db("NULL"); #Connects to DB
		{
        $sql = "UPDATE users SET forename='" . $_POST['forename'] . "', surname='" . $_POST['surname'] . "', device_id='" . $_POST['deviceid'] . "', phone_num='" . $_POST['phonenum'] . "', email='" . $_POST['email'] . "', password='" . $_POST['PasswordUpdate'] . "'WHERE username='". $_POST['username'] . "'";
		} #Updates all table fields as a catch all solution even if the value is the same.		
        $result = mysqli_query($connect, $sql);
		
}
?>
<!DOCTYPE html>
<html>
  <head>
  <link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
  <link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
    <title>Admin Profile | Project Gonzo</title> <!--Page title -->
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
	  <form method ="POST" action="AdminPage.php">	

	  <div id="DropDown" style="padding-top: 10px; text-align: center;">
		<label> Please Select a User: </label>
		<select class="form-dropdown" style="width:150px" id="Dropdown" name="DD">
		<?php echo retrieve_users_DropDown(); ?>
	   </select>
	   <br>
	   </div>

	  <div style="padding-top: 10px;padding-left: 50px;">
		<input type="submit" value="Show User Details" name="UpdateDetailsView">	
	  </div>
	  
	  <div id="Username" style="padding-top: 10px;">
		<label> Username: </label>
		<input type ="text" name="username" value=<?php echo '"' . $value->username . '"' ?>>   
	   </div>
	 	   
	  <!--As for all the values in the form, the variable $value defined earlier is used to map to each table value to the form field name.-->
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
		
		
		<div id= "Update_Password" style="padding-top: 10px;">
		 <label> Update Password: </label>
		 <input type ="password" name="PasswordUpdate" value=<?php echo '"' . $value->password . '"' ?>>
		</div> 
		

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
