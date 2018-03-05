<!DOCTYPE html>
<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
	$(document).ready(function(){
		$(':radio').on('change', function() {
			$(':radio').not(this).prop('checked', false);  
		});
	});
  </script>
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

		$stmt2 = $con->prepare("SELECT *
								FROM Prep
								WHERE TestId= ?
								LIMIT 1");
		$stmt2->bind_param("i", $_GET['testId']);
		$stmt2->execute();

		$result = $stmt2->get_result();
		$data = $result->fetch_all(MYSQLI_ASSOC);
		

		$sample1 = explode(".", $data[0]['S1']);
		$sample2 = explode(".", $data[0]['S2']);
		$sample3 = explode(".", $data[0]['S3']);
		$sample4 = explode(".", $data[0]['S4']);
		$sample5 = explode(".", $data[0]['S5']);
		$sample6 = explode(".", $data[0]['S6']);

		$prepArray = array($sample1, $sample2, $sample3, $sample4, $sample5, $sample6);
		
		$stmt2->close();
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
				<form name="judgeSubmit" action='/judge_submit'><br>
				<input type="text" name="judgeName" placeholder="Your name"><br>
				<?php
				//hidden inputs to submit testId and testType as get vars
				if(isset($_GET['testId'])) { 
						echo"<input type='hidden' name='testId' value='". $_GET['testId'] . "'>"; 
						echo"<input type='hidden' name='testType' value='". $testType . "'>";
				}
				//Intensity test
				if($testType == 1){
					for($i = 0; $i < $numberOfSamples; $i++){
						echo "<div class='testAttribute'>";
						echo "Sample #" . $prepArray[$i][1];
						echo "<p>";
						//9-point scale
						if($attributeType == 1){
							echo "<input type='number' id='selection1' name='".$prepArray[$i][0]."' min='1' max='9'>";
						}
						//6-point scale
						if($attributeType == 2){
							echo "<input type='number' id='selection1' name='".$prepArray[$i][0]."' min='1' max='6'>";
						}
						//unstructured scale
						if($attributeType == 3){
							echo "<input class='slider cen' value='50' type='range' min='0' max='100' name='".$prepArray[$i][0]."' step='1' list='tickmarks'>";
							//echo "<datalist id='tickmarks'><option value='0'><option value='10'><option value='20'><option value='30'><option value='40'><option value='50'><option value='60'><option value='70'><option value='80'><option value='90'><option value='100'></datalist>";
						}
						echo "</p><p>&zwnj;</p></div>";
					}
				}
				//Duo-Trio tests
				if($testType == 2){
					echo "<div class='testAttribute'>
						<p> Sample #" . $prepArray[0][1] . "&emsp;<br>
						<input type='radio' name='".$prepArray[0][0]."' value='1'/>
						<br>
						Sample #" . $prepArray[1][1] . "&emsp;<br>
						<input type='radio' name='".$prepArray[1][0]."' value='2'/>
						</p>
						</div>";
				}
				
				//Triangle test
				if($testType == 3){
					echo "<div class='testAttribute'>
						<p> Sample #" . $prepArray[0][1] . "&emsp;<br>
						<input type='radio'  name='".$prepArray[0][0]."' value='1'/>
						</p>
						<p> Sample #" . $prepArray[1][1] . "&emsp;<br>
						<input type='radio'  name='".$prepArray[1][0]."' value='2'/>
						</p>
						<p> Sample #" . $prepArray[2][1] . "&emsp;<br>
						<input type='radio'  name='".$prepArray[2][0]."' value='3'/>
						</p>
						</div>";
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

