<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Room extends Model
{
	use HasTranslations;

	public $translatable = ['name'];

	protected $attributes = [
		'hotel_id' => 0, // [type:integer, model:Hotel]
		'room_type_id' => null, // [type:integer, model:RoomType]
		'size' => 0, // [type:integer]
		'children_allowed' => 0, // [type:integer]
	];

	protected $casts = [];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'room_images', 'room_id', 'inode_id');
	}
}
