<?php
	
	// ----STEP 1: Establish DB connection

	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2019";
	$db = "nayeon_song_db";

	// Create an instance of mysqli class.
	$mysqli = new mysqli($host, $user, $pass, $db);

	// Check for DB connection errors
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		// stops running the program here. Any subsequent code is not executed.
		exit();
	}

	// ----STEP 2: Generate & submit SQL query

	// Get all the records from the genre table
	$sql = "SELECT * FROM genres";

	// Display SQL statement just to be sure that I'm writing it correctly
	echo "<hr>" . $sql . "<hr>";

	// Submit the SQL to the db. query() will retrun results
	$results = $mysqli->query($sql);

	// Check for any SQL/result errors. query() will return false if there are any errors while making the query
	if( !$results ) {
		echo $mysqli->error;
		exit(); // stop here
	}

	var_dump($results);
	// echo only displays strings
	// echo $results;


	// Get the media types from the DB
	$sql_media_types = "SELECT * FROM media_types";
	$results_media_types = $mysqli->query($sql_media_types);
	if( !$results_media_types) {
		echo $mysqli->error;
		exit(); // stop here
	}


	// ----STEP 3: Display results

	// Get number of results aka records in the genre table
	echo "<hr>";
	echo "Number of results: " . $results->num_rows;

	// Get all the genre information like genre name.
	echo "<hr>";
	// var_dump($results->fetch_assoc());

	// Run a while loop to get all the results
	// while($row = $results->fetch_assoc()) {
	// 	var_dump($row);
	// 	echo "<hr>";
	// }


	// ----STEP 4: Close the DB connection
	$mysqli->close();

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
<select name="genre" id="genre-id" class="form-control">
	<option value="" selected>-- All --</option>

	<?php
		// while($row = $results->fetch_assoc()) {
		// 	echo "<option>" . $row["name"] . "</option>";
		// }
	?>

	<!-- Alternative PHP syntax -->
	<?php while($row = $results->fetch_assoc()) : ?>
		<option value="<?php echo $row['genre_id']; ?>">
			<?php echo $row["name"]; ?>	
		</option>
	<?php endwhile; ?>

	<!-- <option value='1'>Rock</option>
	<option value='2'>Jazz</option>
	<option value='3'>Metal</option>
	<option value='4'>Alternative & Punk</option>
	<option value='5'>Rock And Roll</option> -->

</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
					<select name="media_type" id="media-type-id" class="form-control">
						<option value="" selected>-- All --</option>

	<!-- Alternative PHP syntax -->
	<?php while($row = $results_media_types->fetch_assoc()) : ?>
		<option value="<?php echo $row['media_type_id']; ?>">
			<?php echo $row["name"]; ?>	
		</option>
	<?php endwhile; ?>

						<!-- <option value='1'>MPEG audio file</option>
						<option value='2'>Protected AAC audio file</option> -->

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>