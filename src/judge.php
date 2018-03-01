<!DOCTYPE html>
<html>
  <head>
  <title>Judge</title>
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
							   AttributeName,
							   ScaleType,
							   StartDescription,
							   MiddleDescription,
							   EndDescription,
							   TestType
							   FROM Tests
							   WHERE TestId= ?"); 
		$stmt->bind_param("i", $_GET['testId']);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($testName, $testDescription,
						   $numberOfSamples, $attributeName, 
						   $attributeType, $startDescription,
						   $middleDescription, $endDescription, $testType);
		$stmt->fetch();
		$stmt->close();
		$con->close();
	}
  ?>
			
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/judge.css">
  <link rel="stylesheet" href="css/skeleton.css">
	</head>
	<body>
	<div class="navBar">
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<fieldset>
				<h5><?php echo "Judgment: ".$testName; ?></h5>
				<?php echo $testDescription; ?>
				<div class="hrule"></div>
				<form action=''><br>
				<?php
				//Intensity test
				if($testType == 1){
					for($i = 0; $i < $numberOfSamples; $i++){
						echo "<div class='testAttribute'>";
						echo "Sample #<input type='text' class='txtbox'>";
						echo "<p>";
						//9-point scale
						if($attributeType == 1){
							echo "<input type='number' name='quantity' min='1' max='9'>";
						}
						//6-point scale
						if($attributeType == 2){
							echo "<input type='number' name='quantity' min='1' max='6'>";
						}
						//unstructured scale
						if($attributeType > 3){
							echo "<input class='slider cen' value='50' type='range' min='0' max='100' step='10' list='tickmarks'>";
							echo "<datalist id='tickmarks'><option value='0'><option value='10'><option value='20'><option value='30'><option value='40'><option value='50'><option value='60'><option value='70'><option value='80'><option value='90'><option value='100'></datalist>";
						}
						echo "</p>";
						echo "</div>";
					}
				}
				//Duo-Trio tests
				if($testType == 2){
					echo "<div class='testAttribute'>";
					echo "<p> Sample #<input type='text' class='txtbox'> &emsp;";
					echo "<input type='radio' id='selection1' name='data' value='1'/>";
					echo "</p>";
					echo "<p> Sample #<input type='text' class='txtbox'> &emsp;";
					echo "<input type='radio' id='selection1' name='data' value='2'/>";
					echo "</p>";
					echo "</div>";
				}
				//Triangle test
				if($testType == 3){
					echo "<div class='testAttribute'>";
					echo "<p> Sample #<input type='text' class='txtbox'> &emsp;";
					echo "<input type='radio' id='selection1' name='data' value='1'/>";
					echo "</p>";
					echo "<p> Sample #<input type='text' class='txtbox'> &emsp;";
					echo "<input type='radio' id='selection2' name='data' value='2'/>";
					echo "</p>";
					echo "<p> Sample #<input type='text' class='txtbox'> &emsp;";
					echo "<input type='radio' id='selection3' name='data' value='3'/>";
					echo "</p>";
					echo "</div>";
				}
				?>
				<br><input class="button-secondary" method="post" type="submit" value="Submit">
				</form>
				</fieldset>
			</div>
		</div>
	</div>
	</body>
</html>
