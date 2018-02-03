<?php include 'session_check.php'; ?>
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
		<a href="/se/test.php"> + </a>
		<div class="navLogin"><?php if(isset($_SESSION['username'])) { echo '<a data-active href="admin">Admin</a><a href="/se/logout" >Logout</a>'; } ?></div>
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
					<th>Author</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><a href="#">Cake Tenderness</a></td>
					<td>10/31/17 11:15 AM </td>
					<td>11/06/17 3:25 PM</td>
					<td>William R.</</td>
					<td><a href="#">remove</a></td>
				</tr>
				<tr>
					<td><a href="#">Cake Textural Acceptability</a></td>
					<td>11/13/17 1:01 PM </td>
					<td>11/15/17 4:32 PM</td>
					<td>William R.</</td>
					<td><a href="#">remove</a></td>
				</tr>
				<tr>
					<td><a href="#">Sports Drink Sweetness</a></td>
					<td>11/21/17 12:01 PM </td>
					<td>12/03/17 7:59 PM</td>
					<td>Deanna T.</</td>
					<td><a href="#">remove</a></td>
				</tr>
			</tbody>
		</table>
		<a class="button button-create" href="/se/test.php">Create New Test</a>
  </div>
  </div>
</body>
</html>
