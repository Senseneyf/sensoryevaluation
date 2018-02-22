<?php include 'session_check.php'; ?>
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
		<a data-active href=""> + </a>
		<div class="navLogin"><?php if(isset($_SESSION['username'])) { echo '<a data-active href="admin">Admin</a><a href="/se/logout" >Logout</a>'; } ?></div>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="six columns offset-by-three">
				<fieldset>
				<form class="fixed-max-width">
					<label for="testName">Name: </label>
					<input class="u-full-width" type="text" name="testName" style="width:300px">
					<label for="testDiscription">Discription</label>
					<textarea class="u-full-width" name="testDiscription" style="height:100px;"></textarea>
					<label for="sampleNumber">Number of Samples</label>
					<select name="sampleNumber">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
					<br><br><input class="button-secondary" method="post" type="submit" value="Next">
				</form>
				</fieldset>
			</div>
		</div>
	</div>
</body>
</html>
