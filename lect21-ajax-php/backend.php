<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];

	// How to send results to the frontend??
	// var_dump("Hello World");
	// echo "Hello World";
	// return "Hello World";

	// echo only displays STRINGS. can't echo out an array.
	// echo $php_array;

	// Convert the php assoc. array to a JSON string.
	// echo json_encode($php_array);

	// Get variables passed via GET request
	//echo json_encode($_GET["hobby"]);
 
	// Get variables passed via POST request
	// echo json_encode($_POST);







	// Connect to the DB to get the user's search results
	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2019";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// Write SQL to search for user's search term
	$sql = "SELECT * FROM tracks WHERE name LIKE '%" . $_GET['term'] . "%' LIMIT 10; ";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();

	// Create an array to send to the frontend
	$results_array = [];

	// Send the search results back to the frontend
	while( $row = $results->fetch_assoc() ) {
		array_push($results_array, $row);
	}

	echo json_encode($results_array);

?>











