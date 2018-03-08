<?php include 'session_check.php';?>
<?php if($_SERVER['REQUEST_URI'] === '/') header("Location: /index") ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Tests - Sensory Evaluation</title>
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
	<div class="container">
	<div class="row">
	<div class="five column top-offset">
		<h4>My Tests</h4>
		<div class="hrule"></div>
		<table class="u-full-width">
			<thead>
				<tr>
					<th>Title</th>
					<th>Last Modified</th>
					<th><?php if($_SESSION['username'] == 'admin') { echo "User"; } ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				<?php
    				/* connect to DB */
    				$con = new mysqli('localhost','root','applechair','test');
					if($con->connect_error){
						exit("Database connection failed");
					}
					
					/*if the admin is logged in, get all the tests in db */
					if($_SESSION['username'] == 'admin'){
						$stmt = $con->prepare("SELECT * FROM Tests");
					}
					//otherwise just get tests for the specific user
					else{
						/* search db for all tests created by logged in user */
						$stmt = $con->prepare("SELECT *
							  FROM Tests
							  WHERE TestCreator= ?");
						$stmt->bind_param('s', $_SESSION['username']);
					}
					//query the db with the statement
   					$stmt->execute();

    				/* returns result set from query */
    				$result = $stmt->get_result();
					$data = $result->fetch_all(MYSQLI_ASSOC);

					$testIds = array();
					//if the admin is logged in, display the table with the testCreator field
					if($_SESSION['username'] == 'admin'){
						foreach($data as $row){
							array_push($testIds);
							echo "<tr>";
							echo "<td><a href=\"/test_info?testId=" . $row['TestId'] . "&testType=". $row['TestType'] .  "\">" . $row['TestName'] . "</a></td>";
							echo "<td>" . $row['DateCreated'] . "</td>";
							echo "<td>" . $row['TestCreator'] . "</td>";
							echo "<td><a href=\"/test_edit?testId=" . $row['TestId'] . "\">". "Edit</a>	&emsp;";
							echo "<a href=\"/test_delete?testId=" . $row['TestId']. "\">". "Delete</a></td>";
							echo "</tr>";
						}	
					}
					//otherwise just display the table without testCreator
					else{
						foreach($data as $row){
							array_push($testIds);
							echo "<tr>";
							echo "<td><a href=\"/test_info?testId=" . $row['TestId'] .  "\">" . $row['TestName'] . "</a></td>";
							echo "<td>" . $row['DateCreated'] . "</td>";
							echo "<td><a href=\"/test_edit?testId=" . $row['TestId'] . "\">". "Edit</a>	&emsp;";
							echo "<a href=\"/test_delete?testId=" . $row['TestId']. "\">". "Delete</a></td>";
							echo "</tr>";
						}
					}			

    				$con->close();
    				$stmt->close();
				?>
			</tbody>
		</table>
		<a class="button button-create" href="/test_type">Create New Test</a>
  </div>
  </div>
</body>
</html>