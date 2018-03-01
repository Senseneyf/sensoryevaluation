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
		<div class="navLogin"><?php if(isset($_SESSION['username'])) { echo '<a href="admin">Admin</a><a href="/logout" >Logout</a>'; } ?></div>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
			<a class="button" style="float:right;" href="/test_edit?testName=Sports+Drink+Sweetness&testDiscription=Evaluate+the+following+sports+drink+samples+for+tenderness+using+the+following+9+point+scale+by+clicking+or+pressing+on+the+bars+to+mark+your+sweetness+rating.&sampleNumber=4&attributeName=Sweetness&attributeType=5&attributeStartD=Sweet&attributeEndD=Bitter#">Edit</a>
			<h4>Sports Drink Sweetness</h4>
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
							<td>6</td>
							<td>5</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td>11/25/17 3:25 PM</td>
							<td>Kathryn J.</td>
							<td>7</td>
							<td>3</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td>11/25/17 3:11 PM</td>
							<td>Leonard M.</td>
							<td>2</td>
							<td>7</td>
							<td>-</td>
							<td>-</td>
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
