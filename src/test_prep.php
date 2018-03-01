<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Test Prep - Sensory Evaluation</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>
  <div class="navBar">
  </div>
  <div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="six columns offset-by-three">
				<form class="fixed-max-width" action='/test_execution'><br>
					<input type="hidden" name="testId" value=<?php echo $_GET['testId'] ?>>
					<label for="judgeNumber">Number of Judges</label>
					<select name="judgeNumber">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>

					<br><input class="button-secondary" method="post" type="submit" value="Submit"> <a href="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>" class='button'>Cancel</a>
				</form>

			
			</div>
		</div>
    </div>
  </div>
</body>
</html>