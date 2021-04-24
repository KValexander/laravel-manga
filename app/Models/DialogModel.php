<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DialogModel extends Model
{

	protected $table = 'dialog';
	protected $primaryKey = 'id_dialog';

	// protected $fillable = [];
	
	public $timestamps = false;
}
