<?php
	include 'session_check.php';
	
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$dbname = "myDB";

	/* connect to db */
	$con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	// sql to delete a record
	$sql = "DELETE FROM Users WHERE username = '".$username"'";

	if ($conn->query($sql) === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $conn->error;
	}

	$conn->close();
?>