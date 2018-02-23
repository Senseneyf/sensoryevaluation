<?php
	include 'session_check.php';
	
	// If the values are posted, insert them into the database.
	if (isset($_POST['username']) && isset($_POST['password'])){
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = sha1(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

		/* Attempt to connect to db */
		$con = new mysqli('localhost','root','blah','dbname');
		if($con->connect_error){
			exit("Database connection failed");
		}

		$query = "INSERT INTO `user` (username, password) VALUES ('$username', '$password')";
		$result = mysqli_query($connection, $query);
		if($result){
		    $smsg = "User Created Successfully.";
		}else{
		    $fmsg ="User Registration Failed";
		}
	}
?>