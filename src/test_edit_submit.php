<?php
	session_start();
	/* Attempt to connect to db */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	/* Getting fields from html and setting them  */
	if(isset($_GET['testName'])) { $testName = $_GET['testName']; }
	if(isset($_GET['testDescription'])) { $testDescription = $_GET['testDescription']; }
	if(isset($_GET['attributeName'])) { $attributeName = $_GET['attributeName']; }	
	if(isset($_GET['attributeType'])) { $scaleType = $_GET['attributeType']; }
	if(isset($_GET['sampleNumber'])) { $numberOfSamples = $_GET['sampleNumber']; }
	if(isset($_GET['startDescription'])) { $startDescription = $_GET['startDescription']; }
	if(isset($_GET['middleDescription'])) { $middleDescription = "to be implemented"; }//TODO: add this to the html form
	if(isset($_GET['endDescription'])) { $endDescription = $_GET['endDescription']; }
	if(isset($_GET['testType'])) { $testType = $_GET['testType']; }
	if(isset($_GET['testId'])) { $testId = $_GET['testId']; }
	echo $testName . $testDescription . " " . $attributeName . " " .  $scaleType . " " .  $numberOfSamples . " " .  $startDescription . " " .  $middleDescription . " " .  $endDescription . " " .  $testType . " " .  $testId;

	/* If there is a testId defined, then we're editing a test */
    if(isset($_GET['testId'])){
		//printf("testId is set in get");
		//exit(0);
		/* Update row/test in DB (FOR TEST EDITING) */ 
		if($stmt = $con->prepare("UPDATE Tests
							SET TestName = ?,
							TestDescription = ?,
							NumberOfSamples = ?,
							AttributeName = ?,
							ScaleType = ?,
							StartDescription = ?,
							MiddleDescription = ?,
							EndDescription = ?,
							TestCreator = ?,
							TestType = ?
							WHERE TestId = ?")){
	
		$stmt->bind_param("ssisissssii", $testName, $testDescription, 
                                   $numberOfSamples, $attributeName,
                                   $scaleType, $startDescription,
                                   $middleDescription, $endDescription, $_SESSION['username'], $testType, $testId);
		}else{
			exit($con->error);
		}

	/*Otherwise, we are creating a new test */
	}else{
		//printf("testId isn't set in get");
		//exit(0);
		/* Creating a row/test in DB */
		if($stmt = $con->prepare("INSERT INTO Tests (TestName, TestDescription, NumberOfSamples, AttributeName,
												ScaleType, StartDescription, MiddleDescription, EndDescription, TestCreator, TestType)
							 	VALUES (?,?,?,?,?,?,?,?,?,?)")){
    	$stmt->bind_param("ssisissssi", $testName, $testDescription, 
                                   $numberOfSamples, $attributeName,
                                   $scaleType, $startDescription,
                                   $middleDescription, $endDescription, $_SESSION['username'], $testType);
	
    	}else{
			exit($con->error);
		}

	}
	
	//execute test creation/retrieval
    $stmt->execute();
    $stmt->close();
    $con->close();

	header("Location: /index"); 
?>