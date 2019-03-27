<?php
	// Do the same four steps.
	
	// STEP 1: Establish DB connection
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

	// Set characterset to handle symbols, punctuation marks, etc
	$mysqli->set_charset('utf-8');

	// STEP 2: Generate & Submit SQL 
	$sql = "SELECT tracks.name AS track, 
genres.name as genre, 
media_types.name AS media_type,
track_id
FROM tracks
JOIN genres
	ON genres.genre_id = tracks.genre_id
JOIN media_types
	ON media_types.media_type_id = tracks.media_type_id
WHERE 1=1";

// WHERE clause will change depending on what user inputs from search_form.php
var_dump($_GET["track_name"]);

// Check if user has written something in the track_name field
if( isset($_GET["track_name"]) && !empty($_GET["track_name"]) ) {
	$sql = $sql . " AND tracks.name LIKE '%" . $_GET["track_name"] . "%'";
}
// Check if user has selected a genre
if( isset($_GET["genre"]) && !empty($_GET["genre"]) ) {
	$sql = $sql . " AND tracks.genre_id = " . $_GET["genre"];
}
// Check if user has selected a media type
if( isset($_GET["media_type"]) && !empty($_GET["media_type"]) ) {
	$sql = $sql .  " AND tracks.media_type_id = " . $_GET["media_type"];
}

// Add the semicolon at the very end of SQL
$sql = $sql . ";";

// Echo out sql statement to make sure it looks good before submitting it to DB
echo "<hr>" . $sql  ."<hr>";

// Submit the query
$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
}

$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Song Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4 mt-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th></th>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
					<tbody>

						<?php while($row = $results->fetch_assoc()): ?>
							<tr>
								<td>
									<a href="delete.php?track_id=<?php echo $row['track_id']; ?>&track_name=<?php echo $row['track'];?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this track?');">Delete</a>
								</td>
								<td>
									<!-- Turned into a link and added a parameter -->
									<a href="details.php?track_id=<?php echo $row['track_id'];?>">
										<?php echo $row["track"]; ?> 
									</a>
								</td>
								<td><?php echo $row["genre"]; ?></td>
								<td><?php echo $row["media_type"]; ?></td>
							</tr>
						<?php endwhile ?>
						<!-- <tr>
							<td>For Those About To Rock (We Salute You)</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr>

						<tr>
							<td>Put The Finger On You</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr> -->

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>