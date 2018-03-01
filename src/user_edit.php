<?php
	include 'session_check.php';

	
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
			exit("ERROR NO USERS FOUND");
		}

		/* display table */
		foreach($data as $row){
			array_push($tableList);
			echo "<tr>";
			echo "<td>" . $row['username'] . "</td>";						//username
			echo "<td><button onclick=\"edit_password('" . $row['username'] . "')\">Edit Password</button></td>";	//edit pass button
			echo "<td><button onclick=\"delete_user('" . $row['username'] . "')\">Delete User</button></td>";		//remove user button
			echo "</tr>";
		}	

		$usersList->close();
	}

	/* allows for the changing of a specific user's password */
	function edit_password($username){
		/* prepare statement for changing password */


	}

	/* removes user from database */
	function delete_user($username){
		/* prepare statement for deleting user */
		$target = $con->prepare("DELETE FROM Users WHERE username = ?");
		$target->bind_param("i", $username);
		$target->execute();
		$target->close();
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
</head>
<body>
	<div class="navBar">
		<a href="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>">My Tests</a>
		<a data-active href="/test_type"> + </a>
		<div class="navLogin">
		<?php if(isset($_SESSION['username']) && $_SESSION['username'] == "admin") { echo '<a href="admin">Admin</a>'; } if(isset($_SESSION['username'])) { echo '<a href="/logout" >Logout</a>'; } ?></div>
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
					list_users();
				?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>