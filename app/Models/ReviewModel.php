<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{

	protected $table = 'review';
	protected $primaryKey = 'id_review';

	// protected $fillable = [];
	
	public $timestamps = true;
}
