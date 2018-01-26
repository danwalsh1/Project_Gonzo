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
		admin BOOLEAN NOT NULL
		)";
		$result = mysqli_query($connect, $sql);
		
		$sql = "CREATE TABLE device_data (
		record_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		device_id VARCHAR(32) NOT NULL,
		date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		battery_level INT(3) NOT NULL,
		charging_state BOOLEAN NOT NULL
		)";
		$result = mysqli_query($connect, $sql);
	}
?>