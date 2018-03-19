<?php
    session_start(); #Starts a session.
  
	include("../functions/generalFunctions.php"); #Import additional functionality stored in seperate files.
	include("../functions/sqlFunctions.php");

	if(!isset($_SESSION['Username'])){ 	#Checks the session username is set from the login page and then kills off the login page after.
		header("Location: login.php");
		die();				#Stops the php script from being executed any further
	}
	
	if(isset($_SESSION['admin'])){
		if($_SESSION['admin'] == False){
			header("Location: home.php");
			die();			#Stops the php script from being executed any further
		}
	}else{
		header("Location: logout.php");
		die();				#Stops the php script from being executed any further
	}
  
  
	check_db_exists();  #Checks database existence by calling the function stored in sqlFunctions.php
	
	if(isset($_POST['SubmitProfileForm'])){
		#If the data entry type is correct and equates to true, calls the update user data function.
		$result = update_user_data();
	}
	
	if(isset($_POST['UpdateDetailsView'])){
		$UserSelected = $_POST['DD'];
		#Checked for validity incase of sql injection attempts.
		$result = get_users_values($UserSelected); #Runs the fetch function and displays in the form fields.
	}
		
	function update_user_data(){
       	$connect = connect_db("NULL"); #Connects to DB
		$stmt = "UPDATE users SET forename = ?, surname = ?, device_id = ? , phone_num = ?, email = ?, password = ? WHERE username = ?"; #Statement that will be executed with question mark placeholders.
        $sql = $connect->prepare($stmt); #Statement is prepared, calls connect to open DB connection and then prepares the statement.
		$sql->bind_param('sssssss', $_POST['forename'], $_POST['surname'],$_POST['deviceid'], $_POST['phonenum'], $_POST['email'], $_POST['PasswordUpdate'], $_POST['username']); #Parameters are bound along with the types, which in this case is strings. Pulls the information from the html form entries.
		$sql->execute();#Statement executed.
		$sql->close();#Connection closed.
		
		$msg = "Users information has now been updated!"; 
		messages($msg, "AdminPage.php", 10); #Runs the messages function from the generalFunctions.php page and displays confirmation of input.
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
	    
			<div style="font-family: arial">
				<table align="center"> <!--Form Configuration and positioning -->
					<form method ="POST" action="AdminPage.php">	
						<tr>
							<td>
								<label> Please Select a User: </label>
							</td>
							<td>	<!--Drop down menu of Username's so the Admin can choose which user's data they want to display.-->
								<select class="form-dropdown" style="width:150px" id="Dropdown" name="DD">
									<?php echo retrieve_users_DropDown(); ?>
								</select>
							</td>
						</tr>
					
						<tr>
							<td>
							</td>
							<td>	<!--Submit button for the Admin to confirm they want to load a user's data-->
								<input type="submit" value="Show User Details" name="UpdateDetailsView">
							</td>
						</tr>
	  
						<tr>
							<td>
								<label> Username: </label>
							</td>
							<td>
								<input type ="text" name="username" readonly="readonly" value="<?php if(isset($UserSelected)){echo $result[0];} ?>">
							</td>
						</tr>
	 	   				<!--Updates the values based on whats passed in from the fetch_user_data function.-->
						<!--As for all the values in the form, the variable $result defined earlier is used to map to each table value to the form field name. So 1 for 'forename', 2 for 'surname' and so on.-->
						<tr>
							<td>
								<label> First Name: </label>
							</td>
							<td>
								<input type ="text" name="forename" value="<?php if(isset($UserSelected)){echo $result[1];} ?>">
							</td>
						</tr>
		
						<tr>
							<td>
								<label> Surname: </label>
							</td>
							<td>
								<input type="text" name ="surname" value="<?php if(isset($UserSelected)){echo $result[2];} ?>">
							</td>
						</tr>
		
						<tr>
							<td>
								<label> Device ID: </label>
							</td>
							<td>
								<input type ="text" name="deviceid" value="<?php if(isset($UserSelected)){echo $result[3];} ?>">
							</td>
						</tr>
		 
						<tr>
							<td>
								<label> Phone Number: </label>
							</td>
							<td>
								<input type ="text" name="phonenum" value="<?php if(isset($UserSelected)){echo $result[4];} ?>">
							</td>
						</tr>
		
						<tr>
							<td>
								<label> Email Address: </label>
							</td>
							<td>
								<input type ="text" name="email" value="<?php if(isset($UserSelected)){echo $result[5];} ?>">
							</td>
						</tr>
		
						<tr>
							<td>
								<label> Update Password: </label>
							</td>
							<td>
								<input type ="password" name="PasswordUpdate" value="<?php if(isset($UserSelected)){echo $result[6];} ?>">
							</td>
						</tr>

						<tr>
							<td>
							</td>
							<td>
								<input type="submit" value="Save" name="SubmitProfileForm">
							</td>
						</tr>
					</form>
				</table>
			</div>
	  
			<div id="Footer">
			</div>
		</div>
	</body>
</html>
