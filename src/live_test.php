<?php include 'session_check.php' ?>
<?php
    /* connect to DB */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	if(isset($_GET['testId'])){ $testId = $_GET['testId'];}

	/* query for test type */
	$stmt = $con->prepare("SELECT TestType, NumberOfSamples, TestName
							FROM Tests
							WHERE TestId= ?");
	$stmt->bind_param('i', $_GET['testId']);
   	$stmt->execute();
   	$stmt->store_result();
   	$stmt->bind_result($testType, $numberOfSamples, $testName);
   	$stmt->fetch();

	$stmt2 = $con->prepare("SELECT COUNT(*) FROM Prep WHERE testId=?");
	$stmt2->bind_param('i', $_GET['testId']);
	$stmt2->execute();
	$stmt2->store_result();
	$stmt2->bind_result($rowCount);
	$stmt2->fetch();

	if($rowCount == 0){

		/* inserts a new record for each judge */
		$stringArray = array();
		/*checking to see how many samples we need in prep row */
		/*designates the end of the letter range possible for samples */
		switch ($numberOfSamples){
			case 1:
				$rangeEnd = 'A';
				break;
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
				$sampleArray = range('A', $rangeEnd);
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
				for ($i = 0; $i < $numberOfSamples; $i++ ){
					$stringArray[$i] = $sampleArray[$i] . "." . rand(100,999);
				}
			}

				/*Write to DB*/
			if($stmt3 = $con->prepare("INSERT INTO Prep
									VALUES(?,?,?,?,?,?,?)")){
				$stmt3->bind_param("issssss", $testId , $stringArray[0], $stringArray[1],
														$stringArray[2], $stringArray[3], 
														$stringArray[4],$stringArray[5]);	
				$stmt3->execute();
				$stmt3->close();
			}else{
				exit($con->error);
			}
		}
	}				
	

	/* search db for all tests created by logged in user */
	$stmt3 = $con->prepare("SELECT *
							FROM Prep
							WHERE testId= ?");
	$stmt3->bind_param('i', $_GET['testId']);
   	$stmt3->execute();
   	$result = $stmt3->get_result();
	$data = $result->fetch_all(MYSQLI_ASSOC);

   	$stmt->close();
   	$stmt3->close();
   	$con->close();
   	

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sensory Evaluation</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
  <link rel="stylesheet" media="screen" href="css/custom.css"/>
  <link rel="stylesheet" href="css/normalize.css"/>
  <link rel="stylesheet" href="css/skeleton.css"/>
  <link rel="stylesheet" media="print" href="css/print.css" />
</head>
<body>
  <div class="navBar">
	<?php include 'navbar.php';?>
  </div>
  <div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="six columns offset-by-three">
				<table class="u-full-width">
				<p>This is a preparation page for <?php echo $testName ?> </p>
				<p>Each cell of this contains a letter for sample type, and a random id for your sample. The rows are the orientation of the sample.
					The rows go from top to bottom, so the first row is your first judge.
					</p>
				<a class="button" style="color:#A30F37;" onclick="window.print()">Print</a>&emsp;<a class='button' href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a>
				<thread>
					<?php
						/* changing table headers based on type of test */
						/*DUO TRIO TEST*/
						if($testType == 2){
							echo "<th> Reference </th>";
							echo "<th> Sample 1 </th>";
							echo "<th> Sample 2 </th>";
						}

						/*INTENSITY TEST*/
						if($testType == 1 || $testType == 3){
							for($i = 1; $i < $numberOfSamples+1 ; $i++){
								echo "<th> Sample " . $i . " </th>";
							}
						}
					?>
				</thread>
				<tbody>
					<?php

						/* INTENSITY TEST */
						if($testType == 1 || $testType == 3){
							foreach($data as $row){

								echo "<tr>";
								for($j = 1; $j < $numberOfSamples+1; $j++){
									echo "<td>" . $row['S' . $j] . "</td>";
								}
								echo "</tr>";
							}	
						}	

						/*DUO TRIO */
						if($testType == 2){
							foreach($data as $row){

								echo "<tr>";
								echo "<td> A </td>";
								for($j = 1; $j < $numberOfSamples+1; $j++){
									echo "<td>" . $row['S' . $j] . "</td>";
								}
								echo "</tr>";
							}
						}

    					$con->close();
    					$stmt->close();
					?>
				</tbody>
			</table>
			</div>
		</div>
    </div>
  </div>
</body>
</html>