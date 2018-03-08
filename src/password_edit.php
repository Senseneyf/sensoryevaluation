<?php
	include 'session_check.php';

	/* admin-only access */
	if(strcmp($_SESSION['username'], "admin") != 0){
		header("Location: /index");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Change user password - Sensory Evaluation</title>
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
		<div class="twelve columns top-offset">
			<div class="six columns offset-by-three">
				<?php echo "<p>Changing password for: " . $_GET['user'] . "</p>"; ?>
				<form method="post" action="password_edit.php" name="registerform" id="registerform">
				<fieldset>
				<input hidden name="username" value="<?php echo $_GET['user']; ?>">
				<label for="password">New Password:</label><input type="password" name="password" id="password" required><br />
				<label for="password2">Confirm New Password:</label><input type="password" name="password2" id="password2" required><br />
				<input type="submit" name="register" id="register" value="Register" />
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	/* connect to db */
	$con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}

	/* change the password for this user */
	if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])){
		$username = $_POST['username'];
		$password = sha1(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$password2 = sha1(filter_var($_POST['password2'], FILTER_SANITIZE_STRING));

		/* check if passwords match */
		if (strcmp($password,$password2) != 0) {
			echo '<script> alert("passwords do not match, try again"); </script>';
			exit();
		}

		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		try{
			/* prepare statement */
			$checkpass = $con->prepare("SELECT 1 FROM Users WHERE username = ? AND password = ?");
			$checkpass->bind_param("ss", $username, $password);
			$checkpass->bind_result($exists);
			$checkpass->execute();
			$checkpass->fetch();

			/* if the query has found a match of the username */
			if($exists){
				$checkpass->close();
				echo '<script> alert("Sorry, but that password is the same as the current, please try again"); </script>';
			}

			/* all conditions met - insert into db*/
			else{
				$checkpass->close();
				/* prepare statement for insertion */
				$registerquery = $con->prepare("UPDATE Users SET password = ? WHERE username = ?");
				$registerquery->bind_param("ss", $password, $username);

				/* attempt update */
				if($registerquery->execute()){
					//$registerquery->close();
					echo '<script> alert("Password change successful!"); </script>';
				}
				
				else{
					$registerquery->close();
					echo '<script> alert("Error: Unable to change password"); </script>';
					exit("Registration error");
				}
			}
		}

		catch(Exception $e){
			/* unknown error has occured */
			error_log($e);
		}
	}
?>