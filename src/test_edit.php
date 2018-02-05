<?php include 'session_check.php'; ?>
<?php
	if(isset($_GET['testName'])){
		$testName = $_GET['testName'];
	}
	else{
		$testName = "";
	}
	if(isset($_GET['testDiscription'])){
		$testDiscription = $_GET['testDiscription'];
	}
	else{
		$testDiscription = "";
	}
	if(isset($_GET['sampleNumber'])){
		$sampleNumber = $_GET['sampleNumber'];
	}
	else{
		$sampleNumber = 1;
	}
	if(isset($_GET['attributeName'])){
		$attributeName = $_GET['attributeName'];
	}
	else{
		$attributeName = "";
	}
	if(isset($_GET['attributeType'])){
		$attributeType = $_GET['attributeType'];
	}
	else{
		$attributeType = 3;
	}
	if(isset($_GET['attributeStartD'])){
		$attributeStartD = $_GET['attributeStartD'];
	}
	else{
		$attributeStartD = "";
	}
	if(isset($_GET['attributeEndD'])){
		$attributeEndD = $_GET['attributeEndD'];
	}
	else{
		$attributeEndD = "";
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
		<a href="/se/">My Tests</a>
		<a data-active href="/se/test_edit"> + </a>
		<div class="navLogin"><?php if(isset($_SESSION['username'])) { echo '<a href="admin">Admin</a><a href="/se/logout" >Logout</a>'; } ?></div>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<fieldset>
				<h4>Test creation</h4>
				<div class="hrule"></div>
				<form class="fixed-max-width"><br>
					<label for="testName">Name: </label>
					<input class="u-full-width" type="text" name="testName" <?php echo 'value="'.htmlspecialchars($testName).'"'; ?> style="width:300px">
					<label for="testDiscription">Discription</label>
					<textarea class="u-full-width" name="testDiscription" style="height:115px;"><?php echo htmlspecialchars($testDiscription); ?></textarea>
					<label for="sampleNumber">Number of Samples</label>
					<select name="sampleNumber">
						<option <?php if($sampleNumber == 1){ echo selected; }?> value="1">1</option>
						<option <?php if($sampleNumber == 2){ echo selected; }?> value="2">2</option>
						<option <?php if($sampleNumber == 3){ echo selected; }?> value="3">3</option>
						<option <?php if($sampleNumber == 4){ echo selected; }?> value="4">4</option>
						<option <?php if($sampleNumber == 5){ echo selected; }?> value="5">5</option>
						<option <?php if($sampleNumber == 6){ echo selected; }?> value="6">6</option>
					</select>
					<fieldset>
					<label for="attributes">Attributes</label>
					<div>Name: <input class="u-full-width" type="text"  name="attributeName" <?php echo 'value="'.htmlspecialchars($attributeName).'"'; ?> style="width:150px"></div>
					<div>Type: <select name="attributeType">
						<option <?php if($attributeType == 1){ echo selected; }?> value="1">Input int</option>
						<option <?php if($attributeType == 2){ echo selected; }?> value="2">Input string</option>
						<option <?php if($attributeType == 3){ echo selected; }?> value="3">9 point scale</option>
						<option <?php if($attributeType == 4){ echo selected; }?> value="4">6 point scale</option>
						<option <?php if($attributeType == 5){ echo selected; }?> value="5">Custom scale</option>
					</select></div>
					<div>Start descriptor: <input class="u-full-width" type="text" name="attributeStartD" <?php echo 'value="'.htmlspecialchars($attributeStartD).'"'; ?> style="width:150px"></div>
					<div>End descriptor: <input class="u-full-width" type="text" name="attributeEndD" <?php echo 'value="'.htmlspecialchars($attributeEndD).'"'; ?> style="width:150px"></div>
					<div><a href="#">Add new attribute</a></div>
					</fieldset>
					<br><input class="button-secondary" method="post" action="/se/test" type="submit" value="Submit"> <input class="button-secondary" method="post" type="submit" value="Cancel">
				</form>
				</fieldset>
			</div>
		</div>
	</div>
</body>
</html>
