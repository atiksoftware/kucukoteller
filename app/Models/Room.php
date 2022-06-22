<?php

namespace App\Models;

use App\Enums\PriceEffect;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Room extends Model
{
	use HasTranslations;

	public $translatable = ['name', 'description'];

	protected $attributes = [
		'hotel_id' => 0, // [type:integer, model:Hotel]

		'bed_type_id' => null, // [type:integer, nullable, model:BedType]

		'size' => 0, // [type:integer]
		'capacity' => 0, // [type:integer]
		'children_allowed' => true, // [type:boolean, default:true]
		'extra_bed_allowed' => true, // [type:boolean, default:true]

		'price_effect' => 0, // [type:float]
		'price_effect_unit' => PriceEffect::PERCENT, // [type:float, enum:PriceEffect, def:1]
	];

	protected $casts = [
		'hotel_id' => 'integer',
		'bed_type_id' => 'integer',
		'size' => 'integer',
		'capacity' => 'integer',
		'children_allowed' => 'integer',
		'price_effect' => 'float',
		'price_effect_unit' => PriceEffect::class,
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'room_images', 'room_id', 'inode_id');
	}

	public function bed_type()
	{
		return $this->belongsTo(BedType::class, 'bed_type_id');
	}
}
