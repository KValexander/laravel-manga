<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarksModel extends Model
{

	protected $table = 'bookmarks';
	protected $primaryKey = 'id_bookmarks';

	// protected $fillable = [];
	
	public $timestamps = true;
}
