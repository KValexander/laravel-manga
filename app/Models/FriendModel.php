<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendModel extends Model
{

	protected $table = 'friend';
	protected $primaryKey = 'id_friend';

	// protected $fillable = [];
	
	public $timestamps = true;
}
