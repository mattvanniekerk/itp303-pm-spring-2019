<?php

/********************
 *
 * json_encode():	PHP Array => JSON String
 *
 ********************/

$php_array = [
	"first_name" => "Michael",
	"last_name" => "Scott",
	"age" => 40,
	"phone" => [
		"cell" => [
			"123-4567",
			"555-5555"
		],
		"home" => "456-456-4567"
	],
];

echo $php_array["first_name"];
echo "<hr>";
echo $php_array["phone"]["cell"][0];
echo "<hr>";

// Convert PHP array into a JSON string
echo json_encode($php_array);
echo "<hr>";



/********************
 *
 * json_decode():	JSON String => PHP Array / PHP Object
 *
 ********************/

$json = 
'{
	"first_name": "Michael",
	"last_name": "Scott",
	"age": 40,
	"phone": {
		"cell": "123-123-1234",
		"home": "456-456-4567"
	}
}';

// echo $json.first_name;

// Convert json string to PHP array
$decoded_array = json_decode($json, true);
var_dump($decoded_array);
echo "<hr>";
echo $decoded_array["last_name"];
echo "<hr>";
echo $decoded_array["phone"]["cell"];
echo "<hr>";

// Convert json string to PHP objects
$decoded_object = json_decode($json, false);
var_dump($decoded_object);
echo "<hr>";
echo $decoded_object->first_name;
echo $decoded_object->phone->cell;


/********************
 *
 * cURL & iTunes API
 *
 ********************/

// Define constant for the endpoint
define("ITUNES_API_ENDPOINT", "https://itunes.apple.com/search");

// Initiate curl
$curl = curl_init();

// Set curl options
curl_setopt($curl, CURLOPT_URL, ITUNES_API_ENDPOINT . "?term=beatles&limit=5");

// Return the response as a string and doesn't print it to the page.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// Verifies the authenticity of the peer's certificate
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// Send the request via curl & get some kind of response back
$response = curl_exec($curl);
echo "<hr>";
var_dump($response);

// Convert the json response to php array
$response = json_decode($response, true);
echo "<hr>";
var_dump($response);

// Now can grab pieces off the data because it's an array!
echo "<hr>";
echo $response["resultCount"];
echo "<hr>";
echo $response["results"][0]["trackName"];

// close connection when finished.
curl_close($curl);

?>


















