<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create new user - Sensory Evaluation</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
</head>
<body>
	<div class="navBar">
	<a href="/se/">My Tests</a>
	<a href="/se/test_edit"> + </a>
	<div class="navLogin"><?php if(isset($_SESSION['username'])) { echo '<a data-active href="admin">Admin</a><a href="/se/logout" >Logout</a>'; } ?></div>
	</div>
	<div class="container">
	<?php
		/* connect to db */
		$con = new mysqli('localhost','root','applechair','test');
		if($con->connect_error){
			exit("Database connection failed");
		}

		/* create new user account if valid input recieved*/
		if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2'])){

			$username = mysql_real_escape_string($_POST['username']);
			$password = md5(mysql_real_escape_string($_POST['password']));
			$password2 = md5(mysql_real_escape_string($_POST['password2']));

			/* check if passwords match */
			if (strcmp($password,$password2) != 0) {
				echo "<h1>Error</h1>";
				echo "<p>The passwords entered do not match</p>";
			}

			/* check if username already exists */
			$checkusername = mysql_query("SELECT * FROM Users WHERE username = '".$username"'");
			if(mysql_num_rows($checkusername) == 1){
				echo "<h1>Error</h1>";
				echo "<p>Sorry, that username is taken. Please go back and try again</p>";
			}

			/* all conditions met - insert into db*/
			else{
				$registerquery = mysql_query("INSERT INTO Users (Username, Password) VALUES('".$username."', '".$password."')");
				if ($registerquery){
					echo "<p>Account created successfully</p>";
				}
				
				else{
					echo "<h1>Error</h1>";
					echo "<p>Sorry, account registration failed</p>";
				}
			}
		}

		/* otherwise prompt for reattempt */
		else{
			echo "<h1>Error</h1>";
			echo "<p>Please check your credentials and try again</p>";
		}
	?>
	 
	<form method="post" action="user_create.php" name="registerform" id="registerform">
	<fieldset>
		<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
		<label for="password2">Re-enter Password:</label><input type="password2" name="password2" id="password2">
		<input type="submit" name="register" id="register" value="Register" />
	</fieldset>
	</form>
	</div>
</body>
</html>