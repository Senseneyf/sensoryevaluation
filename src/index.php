<?php include 'session_check.php';?>
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
		<a data-active href="/se/">My Tests</a>
		<a href="/se/test_edit"> + </a>
		<div class="navLogin"><?php if(isset($_SESSION['username'])) { echo '<a href="admin">Admin</a><a href="/se/logout" >Logout</a>'; } ?></div>
	</div>
	<div class="container">
	<div class="row">
	<div class="five column top-offset">
		<table class="u-full-width">
			<thead>
				<tr>
					<th>Title</th>
					<th>Date created</th>
					<th>Last modified</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				<?php
   					/* TODO: check if admin is using */

    				/* connect to DB */
    				$con = new mysqli('localhost','root','applechair','test');
					if($con->connect_error){
						exit("Database connection failed");
					}
	
    				/* search db for all tests created by logged in user */
    				$stmt = $con->prepare("SELECT *
                          FROM Tests
                          WHERE TestCreator= ?");

    				$stmt->bind_param('s', $_SESSION['username']);
   					$stmt->execute();

    				/* returns result set from query */
    				$result = $stmt->get_result();
					$data = $result->fetch_all(MYSQLI_ASSOC);

					$testIds = array();
					foreach($data as $row){
						array_push($testIds);
						echo "<tr><td><a href=\"/se/test_edit?testId=" . $row['TestId'] .  "\">" . $row['TestName'] . "</a>" .
							"</td><td>" . $row['DateCreated'] . "</td></tr>";
					}				

    				$con->close();
    				$stmt->close();
				?>
			</tbody>
		</table>
		<a class="button button-create" href="/se/test_edit">Create New Test</a>
  </div>
  </div>
</body>
</html>
