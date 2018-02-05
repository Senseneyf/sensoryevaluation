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
  <style type="text/css">
  h5{
	  /*text-decoration: underline;*/
	  margin-bottom: 0;
  }
  
  </style>
</head>
<body>
	<div class="navBar">
		<a href="/se/">My Tests</a>
		<a href="/se/test_edit"> + </a>
		<div class="navLogin"><?php if(isset($_SESSION['username'])) { echo '<a href="admin">Admin</a><a href="/se/logout" >Logout</a>'; } ?></div>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<a class="button" style="float:right;" href= "/se/test_edit?testName=Cake+Textural+Acceptability&testDiscription=Exceptional+quality+cakes+should+have+a+fine+and+even+textural+appearance%2C+thin+cell+walls%2C+small+air+cells%2C+and+have+a+soft+velvety+texture.+Evaluate+the+following+cake+samples+using+a+9-point+scale+where%3A+%0D%0A1+%3D+poor+textural+quality+cake%0D%0A5+%3D+acceptable+textural+quality+cake%0D%0A9+%3D+exceptional+textural+quality+cake.&sampleNumber=4&attributeName=Acceptability+Score&attributeType=1&attributeStartD=&attributeEndD=#">Edit</a>
				<h4>Cake Textural Acceptability</h4>
				<div class="hrule"></div>
				<div><br><h5>Judgment Results</h5>
				<table class="u-full-width">
					<thead>
						<tr>
							<th>Date/Time (DEC)</th>
							<th>Judge</th>
							<th>S1</th>
							<th>S2</th>
							<th>S3</th>
							<th>S4</th>
							<th>S5</th>
							<th>S6</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>11/25/17 3:52 PM</td>
							<td>James K.</td>
							<td>9</td>
							<td>9</td>
							<td>9</td>
							<td>9</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td>11/25/17 3:25 PM</td>
							<td>Kathryn J.</td>
							<td>2</td>
							<td>5</td>
							<td>9</td>
							<td>2</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td>11/25/17 3:11 PM</td>
							<td>Leonard M.</td>
							<td>6</td>
							<td>3</td>
							<td>7</td>
							<td>9</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td>11/25/17 2:41 PM</td>
							<td>William R.</td>
							<td>7</td>
							<td>3</td>
							<td>1</td>
							<td>9</td>
							<td>-</td>
							<td>-</td>
						</tr>
					</tbody>
				</table>
				</div>
				<a class="button" href="#">Download</a>
			</div>
		</div>
	</div>
</body>
</html>
