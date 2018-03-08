<?php

		/* inserts a new record for each judge */
		$stringArray = array();
		/*checking to see how many samples we need in prep row */
		/*designates the end of the letter range possible for samples */
		switch ($sampleNumber){
					case 1:
					case 2:
						$rangeEnd = 'B';
						break;
					case 3:
						$rangeEnd = 'C';
						break;
					case 4:
						$rangeEnd = 'D';
						break;
					case 5:
						$rangeEnd = 'E';
						break;
					case 6:
						$rangeEnd = 'F';
						break;
					default:
						exit("Something is wrong in switch statement");
						break;
		}
		for($j = 0; $j < 40 ; $j++){

			/* prep for duo trio tests */
			if($testType == 2 || $testType ==1){
				$sampleArray = array('A', $rangeEnd);
				shuffle($sampleArray);

				/* create strings for prep db with sample, and random id */
				for ($i = 0; $i < $numberOfSamples; $i++ ){
					$stringArray[$i] = $sampleArray[$i] . "." . rand(100,999);
				}
			}

			/* prep for Triangle tests */
			if($testType == 3){

				$sampleArray = array('A', 'A', 'B' );
				shuffle($sampleArray);

				/* create strings for prep db with sample, and random id */
				for ($i = 0; $i < $sampleNumber; $i++ ){
					$stringArray[$i] = $sampleArray[$i] . "." . rand(100,999);
				}
			}
			
			/*Write to DB*/
			$stmt2 = $con->prepare("INSERT INTO Prep
									VALUES( ?,?,?,?,?,?,?)");
			$stmt2->bind_param("issssss", $testId, $stringArray[0], $stringArray[1],
													$stringArray[2], $stringArray[3], 
													$stringArray[4],$stringArray[5]);	
			$stmt2->execute();
		}				
	}else{
		exit($con->error);
	}
    $stmt->close();
    $con->close();		

	header("Location: /index");
?>