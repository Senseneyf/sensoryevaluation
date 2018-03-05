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
        $stmt->close();
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
</head>
<body>
  <div class="navBar">
	<?php include 'navbar.php';?>
  </div>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<fieldset>
				<h4>Test Creation: Select Test Type</h4>
				<div class="hrule"></div>
				<form class="fixed-max-width" action='/test_edit'><br>
				<select name='testType'>
				<option value='1'>Intensity Test</option>
				<option value='2'>Duo-Trio Test</option>
				<option value='3'>Triangle Test</option>
				</select>
				<br><input class='button-secondary' method='post' type='submit' value='Submit'> <a href="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>" class='button'>Cancel</a>
				</form>
				</fieldset>
			</div>
		</div>
	</div>
</body>
</html>
