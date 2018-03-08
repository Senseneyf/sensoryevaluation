<?php include 'session_check.php'; ?>
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
							   TestType
							   FROM Tests
							   WHERE TestId= ?"); 
		$stmt->bind_param("i", $_GET['testId']);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($testName, $testDescription,
						   $numberOfSamples, $attributeName, 
						   $attributeType, $testType);
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
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Test Creation - Sensory Evaluation</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<style type="text/css">
	h5{
		/*text-decoration: underline;*/
		margin-bottom: 0;
	}
	
	</style>
</head>
<body>
	<div class="navBar">
		<?php include 'navbar.php';?>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<a class="button" style="float:right;" href="<?php echo "/judge?testId=" . $_GET['testId'] ?>">Judgment</a>
				<h4><?php if(isset($testName))echo $testName; ?></h4>
				<div class="hrule"></div>
				
				<?php if ($testType == 2): ?>
					<div>1 in the A column is a correct guess of the reference sample</div>
				<?php elseif ($testType == 3): ?>
					<div>1 in the B column is a correct guess of the non-reference sample</div>
				<?php endif; ?>
				
				<div><br><h5>Judgment Results</h5>
				<table class="u-full-width">
					<thead>
						<tr>
							<th>Date/Time (DEC)</th>
							<th>Judge Name</th>
							<?php
								for($i=1 ; $i < $numberOfSamples+1 ; $i++){
									switch($i){
										case 1: $letter = 'A'; break;
										case 2: $letter = 'B'; break;
										case 3: $letter = 'C'; break;
										case 4: $letter = 'D'; break;
										case 5: $letter = 'E'; break;
										case 6: $letter = 'F';; break;
									}
									echo "<th>". $letter ."</th>";
								}
							?>
						</tr>
					</thead>
					<tbody>
					<?php

					foreach($data as $row){
						array_push($testIds);
						echo "<tr>";
						echo "<td>" . $row['TimeStamp'] . "</td>";
						echo "<td>". $row['JudgeName'] ."</td>";
						for($j=1; $j < $numberOfSamples+1 ; $j++){
							switch($j){
								case 1: echo "<td>" . $row['A'] . "</td>"; break;
								case 2: echo "<td>" . $row['B'] . "</td>"; break;
								case 3: echo "<td>" . $row['C'] . "</td>"; break;
								case 4: echo "<td>" . $row['D'] . "</td>"; break;
								case 5: echo "<td>" . $row['E'] . "</td>"; break;
								case 6: echo "<td>" . $row['F'] . "</td>"; break;
							}
						}
						echo "</tr>";
					}

					?>
					</tbody>
				</table>
				</div>
				<a class="button" href="<?php echo "/writeToFile?testId=" . $_GET["testId"]; ?>">Download</a>
				<a class="button" href="<?php echo "/live_test?testId=" . $_GET["testId"]; ?>">Prep test for judgment</a>
			</div>
		</div>
	</div>
</body>
</html>
