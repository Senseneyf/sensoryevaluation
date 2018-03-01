<?php include 'session_check.php'; ?>
<?php

	/* check if the testId is set 
       if set, read from db to fill forms for editing */  
	
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
	
	//if the test type is set in the url, set the php var to its value
	if(isset($_GET['testType'])){
		$testType = $_GET['testType'];
	}
	//otherwise set it a default value
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
</head>
<body>
	<div class="navBar">
		<a href="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>">My Tests</a>
		<a data-active href="/test_type"> + </a>
		<div class="navLogin"><?php if(isset($_SESSION['username'])) { echo '<a href="admin">Admin</a><a href="/logout" >Logout</a>'; } ?></div>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<fieldset>
				<h4>Test Creation: 
				<?php
				//print the type of test
				switch($testType){
				case 1: echo "Intensity"; break; 
				case 2: echo "Duo-Trio"; break;
				case 3: echo "Triangle"; break;
				}
				?></h4>
				<div class="hrule"></div>
				<form class="fixed-max-width" action='/test_edit_submit'><br>
					<?php
					//Hidden input fields to set test id and test type when the test is submitted
					if(isset($_GET['testId'])) { 
						echo"<input type='hidden' name='testId' value='". $_GET['testId'] . "'>"; 
					}
					//if test type is set by the url set the field to that value
					if(isset($_GET['testType'])) { 
						echo"<input type='hidden' name='testType' value='". $_GET['testType'] . "'>"; 
					}
					//otherwise set it from the db query
					else{
						echo"<input type='hidden' name='testType' value='". $testType . "'>";
					}
					?>
					<label for="testName">Name: </label>
					<input class="u-full-width" type="text" name="testName" <?php echo "value=\"".htmlspecialchars($testName)."\""; ?> style="width:300px"  required>
					<label for="testDescription">Description</label>
					<textarea class="u-full-width" name="testDescription" style="height:115px;" required><?php echo htmlspecialchars($testDescription); ?></textarea>
					<label for="sampleNumber">Number of Samples</label>
					<select name="sampleNumber">
						<option <?php if($numberOfSamples == 1){ echo selected; }?> value="1">1</option>
						<option <?php if($numberOfSamples == 2){ echo selected; }?> value="2">2</option>
						<option <?php if($numberOfSamples == 3){ echo selected; }?> value="3">3</option>
						<option <?php if($numberOfSamples == 4){ echo selected; }?> value="4">4</option>
						<option <?php if($numberOfSamples == 5){ echo selected; }?> value="5">5</option>
						<option <?php if($numberOfSamples == 6){ echo selected; }?> value="6">6</option>
					</select>
					
					<?php if($testType == 1): ?>
					<fieldset>					
					<label for="attributes">Attributes</label>
					<div>Name: <input class="u-full-width" type="text"  name="attributeName" <?php echo 'value="'.htmlspecialchars($attributeName).'"'; ?> style="width:150px" required></div>
					<div>Type: <select name="attributeType">
						<option <?php if($attributeType == 1){ echo selected; }?> value="1">9 point scale</option>
						<option <?php if($attributeType == 2){ echo selected; }?> value="2">6 point scale</option>
						<option <?php if($attributeType == 3){ echo selected; }?> value="3">Unstructured scale</option>
					</select></div>
					<div>Start descriptor: <input class="u-full-width" type="text" name="startDescription" <?php echo 'value="'.htmlspecialchars($startDescription).'"'; ?> style="width:150px"></div>
					<div>End descriptor: <input class="u-full-width" type="text" name="endDescription" <?php echo 'value="'.htmlspecialchars($endDescription).'"'; ?> style="width:150px"></div>
					</fieldset>
					<?php endif; ?>
					<br><input class="button-secondary" method="post" type="submit" value="Submit"> <a href="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>" class='button'>Cancel</a>
				</form>
				</fieldset>
			</div>
		</div>
	</div>
</body>
</html>
