<?php

	// Check for required fields as usual (only track id, track name, and genre for our purposes)
	if ( !isset($_POST['track_name']) || empty($_POST['track_name']) 
		|| !isset($_POST['genre']) || empty($_POST['genre'])
		|| !isset($_POST['track_id']) || empty($_POST['track_id']) ) {
		$error = "Please fill out all required fields.";
	}
	else {
		$host = "303.itpwebdev.com";
		$user = "nayeon_db_user";
		$pass = "uscItp2019";
		$db = "nayeon_song_db";

		$mysqli = new mysqli($host, $user, $pass, $db);
		if ( $mysqli->errno ) {
			echo $mysqli->error;
			exit();
		}


		// Optional fields are covered like before (only composer in this case).
		if ( isset($_POST['composer']) && !empty($_POST['composer']) ) {
			// User typed in composer field.
			$composer = "'" . $_POST['composer'] . "'";
		} else {
			// User did not type in composer field.
			$composer = "null";
		}

		// Update SQL
		$sql = "UPDATE tracks
			SET name = '" . $_POST['track_name'] . "',
			genre_id = " . $_POST['genre'] .",
			composer = " . $composer . "
			WHERE track_id = " . $_POST['track_id'] . ";";

		echo "<hr>" . $sql . "<hr>";

		$results = $mysqli->query($sql);
		if ( !$results ) {
			echo $mysqli->error;
			exit();
		}

		$mysqli->close();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php?track_id=<?php echo $_POST['track_id']; ?>">Details</a></li>
		<li class="breadcrumb-item"><a href="edit_form.php?track_id=<?php echo $_POST['track_id']; ?>">Edit</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

			<?php if ( isset($error) && !empty($error) ) : ?>

				<div class="text-danger">
					<?php echo $error; ?>
				</div>

			<?php else : ?>

				<div class="text-success">
					<span class="font-italic"><?php echo $_POST['track_name'];?></span> was successfully edited.
				</div>
			<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="details.php?track_id=<?php echo $_POST['track_id']; ?>" role="button" class="btn btn-primary">Back to Details</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>