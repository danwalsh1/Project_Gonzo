<?php
	# Define four named constants
	define('DB_PASSWORD', '');
	define('DB_NAME', 'project_gonzo');
	define('DB_USERNAME', 'root');
	define('DB_HOST', 'localhost');

	function connect_db($type = "FULL"){
		# Used to create and return a connection to either that database or to the DBMS without a database defined.
		if($type == "PART"){
			$connect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
		}else{
			$connect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		}
		
		return $connect;
	}
	
	function check_db_exists(){
		# Checks if the database (DB_NAME constant) has already been created.
		# If the database has not be created yet, the database creation function is called (create_db()).
		$connect = connect_db("PART");
		$selected_db = mysqli_select_db($connect, DB_HOST);
		if(!$selected_db){
			create_db();
		}
	}
	
	function create_db(){
		# Creates the database and the tables.
		# Also creates the default admin account.
		$connect = connect_db("PART");
		
		# Create database with the name stored in the DB_NAME constant.
		$sql = "CREATE DATABASE " . DB_NAME;
		$result = mysqli_query($connect, $sql);
		
		# Create the users table with eight columns.
		$connect = connect_db();
		$sql = "CREATE TABLE users (
		username VARCHAR(20) NOT NULL PRIMARY KEY,
		password VARCHAR(20) NOT NULL,
		admin BOOLEAN NOT NULL,
		forename VARCHAR(20) NOT NULL,
		surname VARCHAR(20) NOT NULL,
		device_id VARCHAR(32) NOT NULL,
		phone_num INT(12) NOT NULL,
		email VARCHAR(100) NOT NULL)";
		$result = mysqli_query($connect, $sql);
		
		# Create the device_battery_data table with five columns.
		$sql = "CREATE TABLE device_battery_data (
		record_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		device_id VARCHAR(32) NOT NULL,
		date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		battery_level INT(3) NOT NULL,
		charging_state BOOLEAN NOT NULL
		)";
		$result = mysqli_query($connect, $sql);
		
		# Create the device_cpu_data table with four columns.
		$sql = "CREATE TABLE device_cpu_data (
		record_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		device_id VARCHAR(32) NOT NULL,
		date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		cpu_percent_avg INT(3) NOT NULL
		)";
		$result = mysqli_query($connect, $sql);
		
		# Insert the default admin account into the users table.
		$sql = "INSERT INTO users (username, password, admin, forename, surname, device_id, phone_num, email) VALUES (
		'admin', 'password', true, 'Admin', 'Admin', 'NONE', '0', 'a')";
		$result = mysqli_query($connect, $sql);
	}
	
	function get_users_values($username){
		# Returns array of details (e.g. forename and surname) of a given username.
		$connect = connect_db();
		$sql = 'SELECT * FROM users WHERE username = ?';
		$stmt = $connect->prepare($sql);
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$val = array($row['username'], $row['forename'], $row['surname'], $row['device_id'], $row['phone_num'], $row['email'],$row['password']);
		
		return $val;
	}
	
	function insert_battery_data($deviceId, $batteryLevel, $chargingState){
		# Used by the insertData.php
		# Inserts the given data into the device_battery_data table.
		$connect = connect_db();
		$sql = "INSERT INTO device_battery_data(device_id, battery_level, charging_state) VALUES (?, ?, ?)";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param('sss', $deviceId, $batteryLevel, $chargingState);
		$stmt->execute();
		$stmt->close();
	}
	
	function insert_cpu_data($deviceId, $cpu){
		# Used by the insertData.php
		# Inserts the given data into the device_cpu_data table.
		$connect = connect_db();
		$sql = "INSERT INTO device_cpu_data(device_id, cpu_percent_avg) VALUES (?, ?)";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param('ss', $deviceId, $cpu);
		$stmt->execute();
		$stmt->close();
	}
?>
