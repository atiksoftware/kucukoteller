<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $attributes = [
		'hotel_id' => null, // [type:integer, model:Hotel]
		'fullname' => '', // [type:string, length:64]
		'email' => '', // [type:string, length:64]
		'comment_content' => '', // [type:string, dbType:text]
		'answer_content' => '', // [type:string, dbType:text]
		'rating' => 0, // [type:integer]
	];

	protected $casts = [
		'hotel_id' => 'integer',
		'fullname' => 'string',
		'email' => 'string',
		'comment_content' => 'string',
		'answer_content' => 'string',
		'rating' => 'integer',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
