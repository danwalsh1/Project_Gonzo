<?php
	session_start(); #Starts a session.
  
	include("../functions/generalFunctions.php"); #Import additional functionality stored in seperate files.
	include("../functions/sqlFunctions.php");
  
	check_db_exists();  
	
	if (isset($_POST['SubmitProfileForm'])){ #Checks to make sure the $_POST form value exists before processing the function call assigned to the variable.
		$result = update_user_data();
	}

	function update_user_data(){
      	$connect = connect_db("NULL"); #Connects to DB
		$stmt = "UPDATE users SET forename = ?, surname = ?, device_id = ? , phone_num = ?, email = ?, password = ? WHERE username = ?"; #Store the sql statement in variable $stmt with placeholders.
        $sql = $connect->prepare($stmt); #connect to db and then prepare the sql statement.
		$sql->bind_param('sssssss', $_POST['forename'], $_POST['surname'],$_POST['deviceid'], $_POST['phonenum'], $_POST['email'], $_POST['PasswordUpdate'], $_POST['username']); #Binds parameters to the placeholders, specifies firstly the type and then the order of which the placeholder values will be entered.
		$sql->execute(); #execute the statement.
		$sql->close();#Close the connection.
			
		$msg = "Your profile details have been updated!"; #Message produced on submit.
		messages($msg, "UserProfile.php", 10);#Calls the messages function stored on generalFunctions.php.
	}
	
	$result = get_users_values($_SESSION['Username']); #Stores the result of the get user values function from the sqlFunction.php page and stores values in $result. 
	
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
	  
	 
			<div style ="text-align: center; font-family:arial"> <!--Form Configuration and positioning -->
				<table align="center">
					<form method ="POST" action="UserProfile.php">
						<tr>
							<td>
								<label> Username: </label>
							</td>
							<td>
								<input type ="text" name="username" readonly="readonly" value=<?php echo $result[0] ?>>    
							</td>
						</tr>
						<!--As for all the values in the form, the variable $result defined earlier is used to map to each table value to the form field name.-->
						<tr>
							<td>
								<label> First Name: </label>
							</td>
							<td>
								<input type ="text" name="forename" value=<?php echo $result[1] ?>>
							</td>
						</tr>
		
						<tr>
							<td>
								<label> Surname: </label>
							</td>
							<td>
								<input type="text" name ="surname" value=<?php echo $result[2] ?>>
							</td>
						</tr>
		
						<tr>
							<td>
								<label> Device ID: </label>
							</td>
							<td>
								<input type ="text" name="deviceid" value=<?php echo $result[3] ?>>
							</td>
						</tr>
		 
						<tr>
							<td>
								<label> Phone Number: </label>
							</td>
							<td>
								<input type ="text" name="phonenum" value=<?php echo $result[4] ?>>
							</td>
						</tr>
		
						<tr>
							<td>
								<label> Email Address: </label>
							</td>
							<td>
								<input type ="text" name="email" value=<?php echo $result[5] ?>>
							</td>
						</tr>
		
						<tr>
							<td>
								<label> Update Password: </label>
							</td>
							<td>
								<input type ="password" name="PasswordUpdate" value=<?php echo $result[6] ?>>
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
