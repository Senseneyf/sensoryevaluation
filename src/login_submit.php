<?php
session_start();

	if(isset($_POST['username']) and isset($_POST['password'])){
    
	/* filter username and password */
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    /* encrypt password  */
    $password = sha1($password);

	/* Attempt to connect to db */
    $connection = mysqli_connect('localhost','root','dbpassword','seneval');
	if (!$connection){
		die("Database connect failed" . mysqli_error($connection));
	}
	
	/* Query db */
	$query = "SELECT * FROM `user` WHERE userid='$username' and password='$password'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$count = mysqli_num_rows($result);
	
	/* if credentials match, set session username */
	if($count == 1){
		$_SESSION['username']  = $username;
		/* redirect to index */
		header("Location: /se/");
		exit();
	}
	else{
		$msg = "Invalid credentials, please try again.";
	}
}
else{
	
}
?>

<html>
<head>
<title>Log in</title>
</head>
<body>
<?php 
	echo "<div class='center'>".$msg."</div>";
	$referrer = $_SERVER['HTTP_REFERER']; 
	header ("Refresh: 2;URL='$referrer'");
?>
</body>
</html>