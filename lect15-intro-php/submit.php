<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

			<div class="col-12">
				<!-- Display Test Output Here -->

				<?php
					// Write PHP here

					// echo - print/display to the browser
					echo "Hello World!";
					echo "<strong>Hello World!</strong>";
					echo "<hr>";

					// variables
					$name = "Tommy";
					$age = 18;

					echo $name;

					// concatenation - with JS, we used + In PHP, it's a period (.)
					echo "<hr>";
					echo "My name is " . $name . " and my age is " . $age;

					echo "<hr>";

					// input validation
					if( isset($name) && !empty($name) ) {
						echo $name;
					}
					else {
						echo "No name.";
					}

					// var_dump() is a useful function to just dump out data
					echo "<hr>";
					var_dump($name);

					// double quotes vs single quotes
					echo "<hr>";
					echo "Double quotes \$name";
					echo "<hr>";
					// single quotes display things 'as is'. literal.
					echo 'Single quotes $name';

					// Date/time
					// Set a timezone
					date_default_timezone_set("America/Los_Angeles");

					// Display current date and time - formatting rules can be found on php.net
					echo "<hr>";
					echo date("m-d-y H:i:s T");

					// Arrays and for loops
					$courses = ["ITP 303", "ITP 405", "WRIT 340"];

					echo "<hr>";
					// Get array values using index
					echo $courses[0];
					echo $courses[1];
					echo "<hr>";

					// For loop to get all values in the array
					for( $i = 0; $i < sizeof($courses); $i++) {
						echo $courses[$i];
					}

					// Associatve Arrays
					// left hand is called KEY
					// right hand is called VALUE
					$courseNames = [
						"ITP 303" => "Full-Stack Web Development",
						"ITP 405" => "Professional Web Dev",
						"WRIT 340" => "Advanced Writing"
					];

					echo "<hr>";
					// Grabbing a value in an array using a KEY
					echo $courseNames["ITP 303"];
					echo "<hr>";
					var_dump($courseNames);

					// Looping through associative arrays
					echo "<hr>";
					foreach($courseNames as $k => $v) {
						echo $k . ": " . $v;
						echo "<br/>";
					}
					// Loop through associative array, only display the values, not the key.
					echo "<hr>";
					foreach($courseNames as $course) {
						echo $course;
						echo "<br/>";
					}

					// $_SERVER superglobal
					echo "<hr>";
					var_dump($_SERVER);
					echo "<hr>";
					echo $_SERVER["HTTP_HOST"];

					// $_POST and $_GET
					echo "<hr>";
					var_dump($_GET);
					echo "<hr>";
					var_dump($_POST);

				?>


			</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
	<?php
		if(isset($_POST["name"]) && !(empty($_POST["name"]))) {
			echo $_POST["name"];
		}
		else {
			echo "<div class='text-danger'>Not provided.</div>";
		}
		
	?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->

	<?php
		if(isset($_POST["email"]) && !(empty($_POST["email"]))) {
			echo $_POST["email"];
		}
		else {
			echo "<div class='text-danger'>Not provided.</div>";
		}
		
	?>
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
	<?php
		if(isset($_POST["subscribe"]) && !(empty($_POST["subscribe"]))) {
			// Run through loop to get all subscribe values
			for($i = 0; $i < sizeof($_POST["subscribe"]);  $i++) {
				echo $_POST["subscribe"][$i] . ", ";
			}

			// Can also run a foreach loop for simplicity
			foreach($_POST["subscribe"] as $subscribe) {
				echo $subscribe . ", ";
			}
		}
		else {
			echo "<div class='text-danger'>Not provided.</div>";
		}
		
	?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>