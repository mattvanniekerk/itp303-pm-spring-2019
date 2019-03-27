<?php
	// See what track_id has been passed.
	var_dump($_GET['track_id']);

	// Check if valid track_id has been given. Display error in HTML if track_id is invalid.
	if( !isset($_GET['track_id']) || empty($_GET['track_id']) ) {
		// Display a nice looking error message to the user
		$error = "Invalid Track ID.";
	}
	else {
		// Else, a valid track_id was given. Connect to DB.
		$host = "303.itpwebdev.com";
		$user = "nayeon_db_user";
		$pass = "uscItp2019";
		$db = "nayeon_song_db";

		// Establish DB Connection
		$mysqli = new mysqli($host, $user, $pass, $db);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}
		// utf8
		$mysqli->set_charset('utf8');

		// Generate the SQL
		$sql = "SELECT tracks.name AS track, 
			artists.name AS artist,
			composer,
			albums.title AS album,
			genres.name AS genre,
			milliseconds,
			bytes,
			unit_price
			FROM tracks
			LEFT JOIN albums
				ON albums.album_id = tracks.album_id
			LEFT JOIN artists
				ON artists.artist_id = albums.artist_id
			LEFT JOIN genres
				ON genres.genre_id = tracks.genre_id
			WHERE track_id =" . $_GET['track_id'] . ";";

		// Check that SQL looks good
		echo "<hr>" . $sql . "<hr>";

		// Submit the query 
		$results = $mysqli->query($sql);
		if(!$results) {
			echo $mysqli->error;
			exit();
		}

		// Don't need to run a while loop this time because we only get one result back - the details on of ONE track.
		$row = $results->fetch_assoc();
		// var_dump($row);

		// Close connection
		$mysqli->close();
	}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Details | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Song Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

			<?php if( isset($error) && !empty($error)) : ?>
				<!-- If error message is set to something, show this div. -->
				<div class="text-danger">
					<?php echo $error; ?>
				</div>

			<?php else : ?>
				<!-- Else, show the table with the details -->
				<table class="table table-responsive">
					<tr>
						<th class="text-right">Track Name:</th>
						<td><?php echo $row['track'];?></td>
					</tr>
					<tr>
						<th class="text-right">Artist Name:</th>
						<td><?php echo $row['artist'];?></td>
					</tr>
					<tr>
						<th class="text-right">Composer:</th>
						<td><?php echo $row['composer']; ?></td>
					</tr>
					<tr>
						<th class="text-right">Album:</th>
						<td><?php echo $row['album'];?></td>
					</tr>
					<tr>
						<th class="text-right">Genre:</th>
						<td><?php echo $row['genre'];?></td>
					</tr>
					<tr>
						<th class="text-right">Milliseconds:</th>
						<td><?php echo $row['milliseconds'];?></td>
					</tr>
					<tr>
						<th class="text-right">Bytes:</th>
						<td><?php echo $row['bytes'];?></td>
					</tr>
					<tr>
						<th class="text-right">Price:</th>
						<td><?php echo $row['unit_price']; ?></td>
					</tr>
				</table>
			<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
				<a href="edit_form.php?track_id=<?php echo $_GET['track_id']; ?>" class="btn btn-warning">Edit This Track</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>