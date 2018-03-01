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
		<a href="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>">My Tests</a>
		<a href="/test_edit"> + </a>
		<?php if(isset($_SESSION['username']) && $_SESSION['username'] == "admin") { echo '<a href="admin">Admin</a>'; } if(isset($_SESSION['username'])) { echo '<a href="/logout" >Logout</a>'; } ?></div>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<a class="button" style="float:right;" href="/test_edit?testName=Cake+Tenderness&testDiscription=Evaluate+the+following+cake+samples+for+tenderness+using+the+following+unstructured+scale+clicking+or+pressing+your+finger+on+the+bars+to+mark+your+tenderness+rating.&sampleNumber=6&attributeName=Tenderness&attributeType=5&attributeStartD=Firm&attributeEndD=Very+soft#">Edit</a>
				<h4>Cake Tenderness</h4>
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
							<td>11/26/17 3:03 PM</td>
							<td>Kathryn J.</td>
							<td>9</td>
							<td>6</td>
							<td>6</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td>11/26/17 2:53 PM</td>
							<td>James K.</td>
							<td>7</td>
							<td>8</td>
							<td>4</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td>11/25/17 7:16 PM</td>
							<td>Leonard M.</td>
							<td>5</td>
							<td>3</td>
							<td>1</td>
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
