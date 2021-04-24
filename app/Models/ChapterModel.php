<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterModel extends Model
{

	protected $table = 'chapter';
	protected $primaryKey = 'id_chapter';

	// protected $fillable = [];
	
	public $timestamps = true;
}
