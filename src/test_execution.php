<?php

	/* Attempt to connect to db */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	if(isset($_GET['testId']) &&
	   isset($_GET['judgeNumber'])){
	
		$judgeNumber = $_GET['judgeNumber'];
		$testId = $_GET['testId'];
		
		if($stmt = $con->prepare("SELECT NumberOfSamples
								  FROM Tests
								  Where TestId = ?")){
			$stmt->bind_param("i", $testId);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($sampleNumber);
			$stmt->fetch();

			/* inserts a new record for each judge */
			for($j = 0; $j < $judgeNumber ; $j++){

			/* create array with indexes = number of samples */
			/* randomize indexes in the array */
				$randomArray1 = range(1, $sampleNumber);
				$randomArray2 = range(1, $sampleNumber);
				$stringArray = array();
				shuffle($randomArray1);
				shuffle($randomArray2);

				/* create strings for prep db with order,sample, and randomid */
				for ($i = 0; $i < $sampleNumber; $i++ ){
					$stringArray[$i] = $randomArray1[$i] . "." .
								  	  $randomArray2[$i] . "." .
								  	  rand(100,999);
					printf($stringArray[$i]);
				}

				/*Write to DB*/
				if($stmt2 = $con->prepare("INSERT INTO Prep
									VALUES( ?,?,?,?,?,?,?)")){
					$stmt2->bind_param("issssss", $testId, $stringArray[0], $stringArray[1],
													$stringArray[2], $stringArray[3], 
													$stringArray[4],$stringArray[5]);	
					$stmt2->execute();
				}
			}
		}else{
			exit($stmt->error);
		}
	}else{
		exit($con->error);
	}
    $stmt->close();
    $con->close();		

	header("Location: /live_test");
?>