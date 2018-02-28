<?php
	
	session_start();
	if(isset($_POST['username']) and isset($_POST['password'])){
	
	/* filter username and password */
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = sha1(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
	$user_id = 0;
	$email = "";			
	/* Attempt to connect to db */
    $con = new mysqli('localhost','root','applechair','test');
	if($con->connect_error){
		exit("Database connection failed");
	}
	/* Query db with prepared statment */
	$stmt = $con->prepare("SELECT id, username, password, email FROM Users WHERE username= ? and password= ? LIMIT 1");
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$stmt->bind_result($user_id, $username, $password, $email);
	$stmt->store_result();

	/* If credentials are found, set the session username and ID */
	if($stmt->num_rows == 1){
		$_SESSION['username']  = $username;
		$_SESSION['user_id']  = $user_id;
		/* redirect to index */
		header("Location: /se/");
		exit();
	}
	$stmt->close();
	$con->close();
}
?>

<html>
<head>
<title>Log in</title>
</head>
<body>
<?php 
	/*If incorrect credentials are given, print a message and redirect to previous page  */
	echo "<div class='center'>Invalid credentials, please try again.</div>";
	$referrer = $_SERVER['HTTP_REFERER']; 
	header ("Refresh: 2;URL='$referrer'");
?>
</body>
</html>