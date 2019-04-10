<?php

require '../config/config.php';

// Server-side validation - another line of defense in case client-side validation failed.
if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all required fields.";
}
else {
	// Let's add this user to the DB!
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Check if username or email address already exists in the users table
	$sql_registered = "SELECT * FROM users
		WHERE username = '" . $_POST['username'] ."' OR email = '" . $_POST['email'] ."';
	";
	echo "<hr>" . $sql_registered . "<hr>";

	// Submit the query
	$results_registered = $mysqli->query($sql_registered);
	if(!$results_registered) {
		echo $mysqli->error;
		exit();
	}

	var_dump($results_registered);

	// If at least one result is given back to us, we need to display an error.
	if( $results_registered->num_rows > 0 ) {
		$error = "Username or email has already been taken. Please choose another one.";
	}
	else {
		// Run password through hashing algorithm
		$hashedPassword = hash('sha256', $_POST['password']);

		var_dump($hashedPassword);
		// exit();

		// Store user
		$sql = "INSERT INTO users(username, email, password)
				VALUES('" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . $hashedPassword . "');
		";

		echo "<hr>" . $sql . "<hr>";

		// Submit the sql statement to the DB
		$results = $mysqli->query($sql);

		if(!$results) {
			echo $mysqli->error;
			exit();
		}
	}

	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">User Registration</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
				<?php endif; ?>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login.php" role="button" class="btn btn-primary">Login</a>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Back</a>
		</div> <!-- .col -->
	</div> <!-- .row -->

</div> <!-- .container -->

</body>
</html>