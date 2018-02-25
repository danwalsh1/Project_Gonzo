<?php
	define('DB_PASSWORD', '');
	define('DB_NAME', 'project_gonzo');
	define('DB_USERNAME', 'root');
	define('DB_HOST', 'localhost');

	function connect_db($type = "FULL"){
		if($type == "PART"){
			$connect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
		}else{
			$connect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		}
		
		return $connect;
	}
	
	function check_db_exists(){
		$connect = connect_db("PART");
		$selected_db = mysqli_select_db($connect, DB_HOST);
		if(!$selected_db){
			create_db();
		}
	}
	
	function create_db(){
		$connect = connect_db("PART");
		
		$sql = "CREATE DATABASE " . DB_NAME;
		$result = mysqli_query($connect, $sql);
		
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
		
		$sql = "CREATE TABLE device_battery_data (
		record_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		device_id VARCHAR(32) NOT NULL,
		date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		battery_level INT(3) NOT NULL,
		charging_state BOOLEAN NOT NULL
		)";
		$result = mysqli_query($connect, $sql);
		
		$sql = "CREATE TABLE device_cpu_data (
		record_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		device_id VARCHAR(32) NOT NULL,
		date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		cpu_percent_avg INT(3) NOT NULL
		)";
		$result = mysqli_query($connect, $sql);
		
		$sql = "INSERT INTO users (username, password, admin, forename, surname, device_id, phone_num, email) VALUES (
		'admin', 'password', true, 'Admin', 'Admin', 'NONE', '0', 'a')";
	}
	
	function get_users_values($username){
		$connect = connect_db();
		$sql = "SELECT * FROM users WHERE username='" . $username . "'";
		$result = mysqli_query($connect, $sql);
		$val = mysqli_fetch_object($result);
		return $val;
	}
	
	function insert_battery_data($deviceId, $batteryLevel, $chargingState){
		$connect = connect_db();
		$sql = "INSERT INTO device_battery_data(device_id, battery_level, charging_state) VALUES (?, ?, ?)";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param('sss', $deviceId, $batteryLevel, $chargingState);
		$stmt->execute();
		$stmt->close();
	}
	
	function insert_cpu_data($deviceId, $cpu){
		$connect = connect_db();
		$sql = "INSERT INTO device_cpu_data(device_id, cpu_percent_avg) VALUES (?, ?)";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param('ss', $deviceId, $cpu);
		$stmt->execute();
		$stmt->close();
	}
?>
