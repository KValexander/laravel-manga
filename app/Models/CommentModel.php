<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{

	protected $table = 'comment';
	protected $primaryKey = 'id_comment';

	// protected $fillable = [];
	
	public $timestamps = true;
}
