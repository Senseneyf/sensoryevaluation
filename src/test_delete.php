<?php

	/* Attempt to connect to db */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	/* If there is a testId defined, then we're deleting a test */
    if(isset($_GET['testId'])){

		/* Update row/test in DB (FOR TEST EDITING) */ 
		if($stmt = $con->prepare("DELETE FROM Tests
								  WHERE TestId = ?")){
	
		$stmt->bind_param("i",  $_GET['testId']);
		}else{
			exit($con->error);
		}
    	$stmt->execute();
    	$stmt->close();
	
    	$con->close();
	}


	header("Location: /index"); 
?>