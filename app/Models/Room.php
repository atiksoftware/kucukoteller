<?php

namespace App\Models;

use App\Enums\PriceEffect;
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

		'price_effect' => 0, // [type:float]
		'price_effect_type' => PriceEffect::PERCENT, // [type:float, enum:PriceEffect, def:1]
	];

	protected $casts = [
		'hotel_id' => 'integer',
		'room_type_id' => 'integer',
		'size' => 'integer',
		'children_allowed' => 'integer',
		'price_effect' => 'float',
		'price_effect_type' => PriceEffect::class,
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'room_images', 'room_id', 'inode_id');
	}
}
