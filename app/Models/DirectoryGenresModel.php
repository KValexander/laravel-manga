<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectoryGenresModel extends Model
{

	protected $table = 'directory_genres';
	protected $primaryKey = 'id_genre';

	// protected $fillable = [];
	
	public $timestamps = false;
}
