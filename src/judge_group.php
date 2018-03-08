<?php include 'session_check.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Test Prep - Sensory Evaluation</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
  <link rel="stylesheet" media="screen" href="css/custom.css"/>
  <link rel="stylesheet" href="css/normalize.css"/>
  <link rel="stylesheet" href="css/skeleton.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <style>
	select{
		width:100%;
		height:300px;
	}
  </style>
  <script>
	  $(document).ready(function() {
		$('#btnRight').click(function(e) {
			var selectedOpts = $('#lstBox1 option:selected');
			if (selectedOpts.length == 0) {
				e.preventDefault();
			}

			$('#lstBox2').append($(selectedOpts).clone());
			$(selectedOpts).remove();
			e.preventDefault();
		});

		$('#btnLeft').click(function(e) {
			var selectedOpts = $('#lstBox2 option:selected');
			if (selectedOpts.length == 0) {
				e.preventDefault();
			}

			$('#lstBox1').append($(selectedOpts).clone());
			$(selectedOpts).remove();
			e.preventDefault();
		});

		$('#subbtn').click(function(e) {
			$('#lstBox2').removeAttr('disabled');	
		});

	});
  </script>
</head>
<body>
  <div class="navBar">
	<?php include 'navbar.php';?>
  </div>
  <div class="container">
	<div class="row">
			<div class="twelve columns top-offset">
				<h4>Create a Group of Tests</h4>
				<div class="hrule"></div>
				<form action="/judge_group_submit">
				<table class="u-full-width">
					<tr>
					<td>
					<b>Available Tests</b><br/>
					<select multiple id='lstBox1'>
						  <?php
							/* connect to DB */
							$con = new mysqli('localhost','root','applechair','test');
							if($con->connect_error){
								exit("Database connection failed");
							}
							
							/*if the admin is logged in, get all the tests in db */
							if($_SESSION['username'] == 'admin'){
								$stmt = $con->prepare("SELECT * FROM Tests");
							}
							//otherwise just get tests for the specific user
							else{
								/* search db for all tests created by logged in user */
								$stmt = $con->prepare("SELECT *
									  FROM Tests
									  WHERE TestCreator= ?");
								$stmt->bind_param('s', $_SESSION['username']);
							}
							//query the db with the statement
							$stmt->execute();

							/* returns result set from query */
							$result = $stmt->get_result();
							$data = $result->fetch_all(MYSQLI_ASSOC);

							$testIds = array();
							//if the admin is logged in, display the table with the testCreator field
							
							foreach($data as $row){
								echo "<option selected id='test' value='". $row['TestName'] ."'>" . $row['TestName'] ."</option>";
							}		

							$con->close();
							$stmt->close();
						?>
					</select><br>
					<input type='button' id='btnRight' value =' Add '/>
					</td>
					<td>
					<b>Selected Tests</b><br/>
					<select multiple disabled name='Tests[]' id='lstBox2'>
					</select><br>
					<input type='button' id='btnLeft' value=' Remove'/>
					</td>
					<tr>
				</table>
				<input class='button-secondary' id='subbtn' method='get' type='submit' value='Submit'> <a href="<?php echo "http://" . $_SERVER['HTTP_REFERER']; ?>" class='button'>Cancel</a>
				</form>
			</div>
    </div>
  </div>
</body>
</html>