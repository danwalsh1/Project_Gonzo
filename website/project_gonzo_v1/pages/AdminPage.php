<?php
  session_start();

  include("../functions/generalFunctions.php");
  include("../functions/sqlFunctions.php");

check_db_exists();



if (isset($_POST['SubmitProfileForm'])){
  $result = update_user_data();
  }

  if(!isset($_SESSION['Username'])){
	  header("Location: login.php");
	  die();
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
<style>
* {padding: 0; margin: 0;}
#TextFields
{
  width:300px;
  height:auto;
  text-align: center;
}
</style>

<!DOCTYPE html>
<html>
  <head>
    <link href="../CSS/mainMenu.css" rel  = "stylesheet" type="text/CSS" />
    <link href="../CSS/mainLayout.css" rel  = "stylesheet" type="text/CSS" />
    <title>Admin Page | Project Gonzo</title>
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

      <div id="Content">
	  <h1> Admin Page </h1>
    <br>
	  <form action="/action_page.php">
      Select Username:
	    <input list="browsers" name="browser">         <!-- To get this to work all we need to do is get this drop down to set the user name for this session,
                                                      then refresh the page which will then load all the necessary deails for the user selected on the drop down.-->
		<datalist id="browsers">				<!-- Below should be changed to fit the needs of our data using PHP. -->
		  <option value="Daniel Walsh">
		  <option value="Gareth Holloway">
		  <option value="Elliot Hawkins">
		  <option value="Jacob Stenson">
		</datalist>

		<input type="submit">
		</form>

    <br>
<div id="TextFields">

  <form action="action_page.php">              <!-- Below should be changed to fit the needs of our data using PHP. -->
  Username:
  <input name="Username" type="text" value=<?php echo '"' . $value->username . '"'?>>
  <br>
  Password:
  <input name="Password" type="text" value=<?php echo '"' .$value->password . '"'?>>
  <br>
  <br>
  Forename:
  <input name="Forename" type="text" value="Forename here.">
  <br>
  Surname:
  <input name="Surname" type="text" value="Surname here.">
  <br>
  Device_ID:
  <input name="Device_ID" type="text" value="Device_ID here.">
  <br>
  Phone Number:
  <input name="Phone_Num" type="text" value="Phone Number here.">
  <br>
  Email:
  <input name="Email" type="text" value="Email here.">
  <br><br>
  <input type="submit" value="Save Details" name="SubmitProfileForm"> <!-- This also needs to be made so it changes the details for the user selected in the drop down and not the user logged in. -->
</form>
</div>



</body>
</html>
      </div>
      <div id="Footer">
      </div>
    </div>
  </body>
</html>
