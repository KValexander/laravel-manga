<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{

	protected $table = 'message';
	protected $primaryKey = 'id_message';

	protected $fillable = ['id_message', 'id_dialog', 'id_sender', 'id_addressee', 'readed', 'sender_delete', 'addressee_delete', 'message', 'date'];
	
	public $timestamps = false;
}
