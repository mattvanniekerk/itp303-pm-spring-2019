<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import Genre & Track models
use App\Genre;
use App\Track;

class SongController extends Controller
{
	public function searchForm() {

		// Interact with the database. Get the genres from the DB.

		// with MYSQLI, we had to run a SQL query like SELECT * FROM genres;
		$genre = new Genre();
		// var_dump( $genre->all() );

		// Send the genre information to the view
		return view('search_form', [
			'genres' => $genre->all(),
			'username' => 'ttrojan',
			'age' => 22
		]);
	}

	public function search() {
		// Grab the user's input
		$track_name = request('track_name');
		$genre = request('genre');

		var_dump($track_name);

		// Search the tracks table for a match
		$track = new Track();

		// Now for the Query something like SELECT * FROM tracks WHERE track=track

		// SELECT statement
		$results = $track->select('tracks.name AS track_name', 'composer', 'genres.name AS genre');

		// Handle optional inputs like track and genre
		if( isset($track_name) && !empty($track_name)) {
			$results = $results->where('tracks.name', 'LIKE', '%' . $track_name . '%');
		}
		if( isset($genre) && !empty($genre)) {
			$results = $results->where('tracks.genre_id', '=', $genre);
		}

		// JOIN tracks and genres table so we can see the names of the genres
		$results = $results->leftJoin('genres', 'tracks.genre_id', '=', 'genres.genre_id');


		return view('search_results', [
			'tracks' => $results->get()
		]);
	}
}

?>










