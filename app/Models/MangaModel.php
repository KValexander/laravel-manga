<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MangaModel extends Model
{

	protected $table = 'manga';
	protected $primaryKey = 'id_manga';

	// protected $fillable = [];
	
	public $timestamps = true;
}
