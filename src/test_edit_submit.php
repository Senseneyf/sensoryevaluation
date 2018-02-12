<?php

	/* Attempt to connect to db */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	/* TODO: making this work? being able to get the html elements from the page and actually applying them

    $testId = $_POST['testId'];
    $testName = $_POST['testName'];
    $testDescription = $_POST['testDescription'];
    $numberOfSamples = $_POST['sampleNumber'];
    $attributeName = $_POST['attributeName'];
    $scaleType = $_POST['attributeType'];
    $startDescription = $_POST['startDescripton'];
    $middleDescription = "to be implemented";
    $endDescription = $_POST['endDescription'];

    /* TODO: conditional to choose if we're updating a test or submitting a new one*/
    
    /* Write to DB */
    $stmt = $con->prepare("INSERT INTO Tests 
                           VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssisissss", $testName, $testDescription, 
                                   $numberOfSamples, $attributeName,
                                   $scaleType, $startDescription
                                   $middleDescription, $endDescription);

	/* Update row in DB */
	/* 
	$stmt = $con->prepare("UPDATE Tests
						   SET TestName = ?,
							   TestDescription = ?,
							   AttributeName = ?,
							   ScaleType = ?,
							   StartDescription = ?,
							   MiddleDescription = ?,
							   EndDescription = ?,
							WHERE TestId = ?");

	$stmt->bind_param("sssisssi",  $testName, $testDescription, 
                                   $attributeName, $scaleType, 
								   $startDescription, $middleDescription, 
								   $endDescription, $testId);

	*/
    
    $stmt->execute();
    $stmt->close();

	$stmt = $con->prepare();
	
    $con->close();
?>