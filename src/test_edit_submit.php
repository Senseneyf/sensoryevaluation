<?php

	/* Attempt to connect to db */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	/* Getting fields from html and setting them */
    if(isset($_GET['testName']) &&
       isset($_GET['testDescription']) &&
       isset($_GET['attributeType']) &&
       isset($_GET['sampleNumber']) &&
       isset($_GET['attributeName']) &&
       isset($_GET['startDescription']) &&
       isset($_GET['endDescription'])){
    
        $testName = $_GET['testName'];
        $testDescription = $_GET['testDescription'];
        $scaleType = $_GET['attributeType'];
        $numberOfSamples = $_GET['sampleNumber'];
        $attributeName = $_GET['attributeName'];
        $startDescription = $_GET['startDescription'];
        $middleDescription = "to be implemented"; //TODO: add this to the html form
        $endDescription = $_GET['endDescription'];
    }else{
		/* TODO: some redirect statement to deal with when all fields aren't set */
	}


	/* If there is a testId defined, then we're editing a test */
    if(isset($_GET['testId'])){

		/* Update row/test in DB (FOR TEST EDITING) */ 
		if($stmt = $con->prepare("UPDATE Tests
						   SET TestName = ?,
							   TestDescription = ?,
							   AttributeName = ?,
							   ScaleType = ?,
							   StartDescription = ?,
							   MiddleDescription = ?,
							   EndDescription = ?,
							WHERE TestId = ?")){
	

		$stmt->bind_param("sssisssi",  $testName, $testDescription, 
                                   $attributeName, $scaleType, 
								   $startDescription, $middleDescription, 
								   $endDescription, $testId);
		}else{
			exit($con->error);
		}

	/*Otherwise, we are creating a new test */
	}else{

		/* Creating a row/test in DB */
		if($stmt = $con->prepare("INSERT INTO Tests (TestName, TestDescription, NumberOfSamples, AttributeName,
												ScaleType, StartDescription, MiddleDescription, EndDescription)
							 	VALUES (?,?,?,?,?,?,?,?)")){
    	$stmt->bind_param("ssisssss", $testName, $testDescription, 
                                   $numberOfSamples, $attributeName,
                                   $scaleType, $startDescription,
                                   $middleDescription, $endDescription);
	
    	}else{
			exit($con->error);
		}

	}
    
    $stmt->execute();
    $stmt->close();
	
    $con->close();

	header("Location: /se/index"); 
?>