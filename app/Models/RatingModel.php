<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{

	protected $table = 'rating';
	protected $primaryKey = 'id_rating';

	// protected $fillable = [];
	
	public $timestamps = true;
}
