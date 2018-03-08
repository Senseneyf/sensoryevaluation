<?php
	/* Attempt to connect to db */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	/* Getting fields from html and setting them  */
	if(isset($_GET['testId'])) { $testId = $_GET['testId']; }
	if(isset($_GET['A'])) { $sampleA = $_GET['A']; }
	if(isset($_GET['B'])) { $sampleB = $_GET['B']; }	
	if(isset($_GET['C'])) { $sampleC = $_GET['C']; }
	if(isset($_GET['D'])) { $sampleD = $_GET['D']; }
	if(isset($_GET['E'])) { $sampleE = $_GET['E']; }
	if(isset($_GET['F'])) { $sampleF = $_GET['F']; }
	if(isset($_GET['testType'])) { $testType = $_GET['testType']; }
	if(isset($_GET['judgeName'])) { $judgeName = $_GET['judgeName']; }

	/* Creating a row in the results table */
	if($stmt = $con->prepare("INSERT INTO Results (JudgeName, TestId, A, B, C, D, E, F) VALUES (?,?,?,?,?,?,?,?)")){
		$stmt->bind_param("siiiiiii", $judgeName, $testId, $sampleA, $sampleB, $sampleC, $sampleD, $sampleE, $sampleF);
	}
	else{
		exit($con->error);
	}

	$stmt2 = $con->prepare("DELETE FROM Prep WHERE testId=? LIMIT 1");
	$stmt2->bind_param("i", $testId);

	//TODO add statement for adding row to Prep DB
		

	//execute test creation/retrieval
    $stmt->execute();
	$stmt2->execute();
    $stmt->close();
	$stmt2->close();
    $con->close();

	header("Location: /index"); 
?>