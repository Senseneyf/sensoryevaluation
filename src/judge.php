<!DOCTYPE html>
<html>
	<head>
			<title>Judge</title>
			<style type="text/css">
			.testAttribute{
				
			}
			.testAttribute:nth-child(even){
				background-color: #eee;
				width:100%;
			}
			.testAttribute:nth-child(odd){
				background-color: #fff;
				width:100%;
			}
			Input.slider{
				width:50%;
			}
			Input.txtbox{
				width:8em;
			}
			.cen{
				width:250px;
				display: block;
				margin-left: auto;
				margin-right: auto;
			}
			.container{
				width:100%;
			}
			input[type=range]{
			-webkit-appearance: none;
			}

			input[type=range]::-webkit-slider-runnable-track {
			width: 300px;
			height: 5px;
			background: #ddd;
			border: none;
			border-radius: 3px;
			}

			input[type=range]::-webkit-slider-thumb {
				-webkit-appearance: none;
				border: none;
				height: 16px;
				width: 16px;
				border-radius: 50%;
				background: blue;
				margin-top: -4px;
			}

			input[type=range]:focus {
				outline: none;
			

			input[type=range]:focus::-webkit-slider-runnable-track {
				background: #ccc;
			}
			</style>
			
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
	  <div style="margin-top:5%;">
			<?php 
			//If the number of attributes is set in the url
			if (isset($_GET['a'])){
				$numAttributes = $_GET['a'];
				if($numAttributes > 6){
					$numAttributes = 6;
				}
				else if($numAttributes < 1){
					$numAttributes = 1;
				}
			}
			//otherwise set it to the default value
			else {
				$numAttributes = 1;
			}
			
			
			//Print html for each of the attributes
			for($i = 0; $i < $numAttributes; $i++){
				//echo "<div id = 'container'>";
				echo "<div class='testAttribute'>";
				//echo "Sample #<input type='text' class='txtbox'>";
				echo "Sample #" . rand(100,999);
				echo "<p>";
				echo "<input class='slider cen' value='50' type='range' min='0' max='100' step='10' list='tickmarks'>";
				echo "<datalist id='tickmarks'><option value='0'><option value='10'><option value='20'><option value='30'><option value='40'><option value='50'><option value='60'><option value='70'><option value='80'><option value='90'><option value='100'></datalist>";
				echo "</p>";
				echo "</div>";
				//echo "</div>";
			}
			echo "<p class='cen'><input type='button' value='Submit'><input type='button' value='Cancel'></p>";
			?>
		</div>
	</body>
</html>
