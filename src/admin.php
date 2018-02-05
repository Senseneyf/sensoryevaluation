<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Log in - Sensory Evaluation</title>
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
	<div class="row">
		<div class="tweleve columns top-offset">
			<div class="nine columns offset-by-one">
				<h4>Admin</h4><div class="hrule"></div><br><br>
				<a href="#" class="button">Id generator</a>
		</div>
    </div>
  </div>
</body>
</html>
