<?php
	include 'session_check.php';
	/* admin-only access */
	if(strcmp($_SESSION['username'], "admin") != 0){
		header("Location: /index");
	}

	
	/* for error logging with MYSQLi */
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	/* creates a table that contains all users currently in db, with contextual buttons */
	function list_users(){
		/* connect to db */
		$con = new mysqli('localhost','root','applechair','test');
		if($con->connect_error){
			exit("Database connection failed");
		}
		$tableList = array();

		/* prepare statement for retrieving users */
		$usersList = $con->prepare("SELECT username FROM Users");
		$usersList->execute();
		$result = $usersList->get_result();
		$data = $result->fetch_all(MYSQLI_ASSOC);

		/* if there are no users found */
		if ($result->num_rows === 0){
			//if this happens, immediately reinsert admin !!!
			exit("ERROR NO USERS FOUND");
		}

		/* display table */
		foreach($data as $row){
			//array_push($tableList);
			echo "<tr>";
			echo "<td>" . $row['username'] . "</td>";																//username
			echo "<td><a href='/password_edit?user=" . $row['username'] . "' class='button'>Change Password </a></td>";	//edit pass button
			/* remove user button shows up for every user except admin */
			if (strcmp($row['username'],"admin") != 0){
				echo "<td><a href='?mode=delete&user=" . $row['username'] . "' class='button' onclick='return checkDelete()'>Delete User </a></td>";	//remove user button
				echo "<td><a href='?mode=deletedt&user=" . $row['username'] . "' class='button' onclick='return checkDeleteTests()'>Delete User and Tests</a></td>";	//remove with tests
			}
			echo "</tr>";
		}	

		$usersList->close();
	}

	/* removes user from database and deletes all their tests if prompted */
	function delete_user($username, $dt){
		
		/* connect to db */
		$con = new mysqli('localhost','root','applechair','test');
		if($con->connect_error){
			exit("Database connection failed");
		}

		/* if user is admin, deny */
		if ($username == "admin"){
			exit("Please don't do that.");
		}

		/* prepare statement for deleting user */
		$target = $con->prepare("DELETE FROM Users WHERE username = ?");
		$target->bind_param("s", $username);
		$target->execute();
		$target->close();

		if ($dt){
			/* prepare statement for deleting user tests */
			$tests = $con->prepare("DELETE FROM Tests WHERE TestCreator = ?");
			$tests->bind_param("s", $username);
			$tests->execute();
			$tests->close();
		}
	}

	if(isset($_GET['mode']) && !empty($_GET['user'])){

		if($_GET['mode'] == 'delete'){
			delete_user($_GET['user'], false);
		}

		if($_GET['mode'] == 'deletedt'){
			delete_user($_GET['user'], true);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Edit Users - Sensory Evaluation</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">

	<script language="JavaScript" type="text/javascript">
	function checkDelete(){
		return confirm('Are you sure you want to delete this user?');
	}

	function checkDeleteTests(){
		return confirm('Are you sure you want to delete this user and all their tests?');
	}
	</script>

</head>
<body>
	<div class="navBar">
		<?php include 'navbar.php';?>
	</div>
	<div class="container">
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<table class="u-full-width">
				<thead>
				<tr>
					<th>Username</th>
					<th></th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php
					/* list out every user in the database, and give contextual controls for editing them */
					list_users();
				?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>