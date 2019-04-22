<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	// This is going to represent the genres table in the db
	// To "link" this model and the table in the DB, have to set up two things:

	protected $table = 'genres';
	protected $primaryKey = 'genre_id';
}

?>