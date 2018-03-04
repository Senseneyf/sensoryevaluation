<?php include 'session_check.php' ?>
<?php
    /* connect to DB */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	/* query for test type */
	$stmt = $con->prepare("SELECT TestType, NumberOfSamples
							FROM Tests
							WHERE TestId= ?");
	$stmt->bind_param('i', $_GET['testId']);
   	$stmt->execute();
   	$stmt->store_result();
   	$stmt->bind_result($testType, $numberOfSamples);
   	$stmt-> fetch();

   	/* search db for all tests created by logged in user */
	$stmt2 = $con->prepare("SELECT *
							FROM Prep
							WHERE testId= ?");
	$stmt2->bind_param('i', $_GET['testId']);
   	$stmt2->execute();

    /* returns result set from query */
    $result = $stmt2->get_result();
	$data = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Test Prep - Sensory Evaluation</title>
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
				<a class="button" style="color:#A30F37;" onclick="window.print()">Print</a>
				<thread>
					<?php
						/* changing table headers based on type of test */
						/*DUO TRIO TEST*/
						if($testType == 2){
							echo "<th> Reference </th>";
							if($numberOfSamples == 1){
								echo "<th> Sample 1 </th>";
							} else{
								echo "<th> Sample 1 </th>";
								echo "<th> Sample 2 </th>";
							}
						}

						/*INTENSITY TEST*/
						if($testType == 1){
							for($i = 1; $i < $numberOfSamples+1 ; $i++){
								echo "<th> Sample " . $i . " </th>";
							}
						}
					?>
				</thread>
				<tbody>
					<?php

						/* INTENSITY TEST */
						if($testType == 1){
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