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
  </div>
  <div class="container">
	<div class="row">
		<div class="twelve columns top-offset">
			<div class="six columns offset-by-three">
			<fieldset>
				<p class="u-full-width">Please login to continue:</p>
				<form class="login" method="post" action="login_submit">
					<label for="userNameInput">Username:</label>
					<input class="u-full-width"  id="username" name="username" value="" type="text" maxlength="100">
					<label for="passwordInput">Password:</label>
					<input class="u-full-width"  id="password" name="password" value="" type="password" maxlength="16" placeholder="">
					<br><br><input class="button-secondary" type="submit" value="Submit"/>
				</form>
			</fieldset>
			</div>
		</div>
    </div>
  </div>
</body>
</html>