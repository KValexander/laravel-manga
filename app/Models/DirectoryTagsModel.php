<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectoryTagsModel extends Model
{

	protected $table = 'directory_tags';
	protected $primaryKey = 'id_tag';

	// protected $fillable = [];
	
	public $timestamps = false;
}
