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
	<title>Admin Tools - Sensory Evaluation</title>
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
	<div class="tweleve columns top-offset">
		<div class="nine columns offset-by-one">
			<h4>Admin</h4><div class="hrule"></div><br><br>
		<a href="/user_create" class="button">Create new user</a>
		<a href="/user_edit" class="button">Edit users</a>
	</div>
	</div>
	</div>
</body>
</html>
