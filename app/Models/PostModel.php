<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{

	protected $table = 'post';
	protected $primaryKey = 'id_post';

	// protected $fillable = [];
	
	public $timestamps = true;
}
