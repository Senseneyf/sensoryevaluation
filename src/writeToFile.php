<?php

if(isset($_GET['testId'])){
		/* connect to db */
		$con = new mysqli('localhost','root','applechair','test');
		if($con->connect_error){
			exit("Database connection failed");
		}
		
		/* prepare statement to read from db */
		$stmt = $con->prepare("SELECT TestName,
							   TestDescription,
							   NumberOfSamples,
							   ProductName,
							   ScaleType,
							   TestCreator,
							   TestType
							   FROM Tests
							   WHERE TestId= ?"); 
		$stmt->bind_param("i", $_GET['testId']);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($testName, $testDescription,
						   $numberOfSamples, $productName, 
						   $attributeType, $testCreator, $testType);
		$stmt->fetch();
		
		$stmt2 = $con->prepare("SELECT 
					   JudgeName,
					   TimeStamp,
					   A,
					   B,
					   C,
					   D,
					   E,
					   F
					   FROM Results
					   WHERE TestId= ?");
		
		$stmt2->bind_param("i", $_GET['testId']);
		$stmt2->execute();
		$result = $stmt2->get_result();
		$data = $result->fetch_all(MYSQLI_ASSOC);		
		
		$stmt->close();
		$stmt2->close();
		$con->close();
		
		$fileName = $testCreator."_".$testName."_".$productName;
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=".$fileName.".csv");



		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('Judge Name','Time Stamp','A', 'B', 'C','D','E','F'));

		// loop over the rows, outputting them
		foreach ($data as $rows){
			fputcsv($output, $rows);
		}
}
?>