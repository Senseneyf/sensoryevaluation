<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register New User - Sensory Evaluation</title>
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
		<div class="twelve columns top-offset">
			<div class="six columns offset-by-three">
				<form method="post" action="user_create.php" name="registerform" id="registerform">
				<fieldset>
				<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
				<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
				<label for="password2">Re-enter Password:</label><input type="password" name="password2" id="password2"><br />
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

	/* create new user account if valid input recieved*/
	if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2'])){

		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = sha1(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$password2 = sha1(filter_var($_POST['password2'], FILTER_SANITIZE_STRING));

		/* check if passwords match */
		if (strcmp($password,$password2) != 0) {
			echo "<h1>Error</h1>";
			echo "<p>The passwords entered do not match, please try again</p>";
		}

		/* check if username already exists using a prepared statment */
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		try{
			/* prepare statement */
			$checkusername = $con->prepare("SELECT 1 FROM Users WHERE username = ? LIMIT 1");
			$checkusername->bind_param("s", $username);
			$checkusername->bind_result($exists);
			$checkusername->execute();
			$checkusername->fetch();

			/* if the query has found a match of the username */
			if($exists){
				$checkusername->close();
				exit("Sorry, that username is taken. Please go back and try again");
			}

			/* all conditions met - insert into db*/
			else{
				$checkusername->close();
				/* prepare statement for insertion */
				$registerquery = $con->prepare("INSERT 
					INTO Users 
					(username, password) 
					VALUES ('$username','$password')");

				/* attempt insertion into db */
				if($registerquery->execute()){
					echo "<p>Account created successfully</p>";
				}
				
				else{
					echo "<h1>Error</h1>";
					echo "<p>Sorry, account registration failed</p>";
					exit("Registration error");
				}

				$registerquery->close();
			}
		}

		catch(Exception $e){
			/* unknown error has occured */
			error_log($e);
		}
	}

	/* otherwise prompt for reattempt */
	else{
		echo "<p>Please fill all the fields</p>";
		exit("Missing username/password");
	}
?>