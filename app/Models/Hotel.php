<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Hotel extends Model
{
	use HasTranslations;

	public $translatable = ['name', 'slug',   'content', 'owner_welcome_text', 'how_is_there_like'];

	protected $attributes = [
		'is_active' => true, // [type:boolean, def:true]

		'email' => null, // [type:string, nullable]
		'email_showable' => false, // [type:boolean, def:false]
		'phone' => null, // [type:string, nullable]
		'phone_showable' => false, // [type:boolean, def:false]
		'whatsapp' => null, // [type:string, nullable]
		'whatsapp_showable' => false, // [type:boolean, def:false]
		'website' => null, // [type:string, nullable]
		'website_showable' => false, // [type:boolean, def:false]
		'latitude' => null, // [type:float, nullable]
		'longitude' => null, // [type:float, nullable]
		'location_showable' => false, // [type:boolean, def:false]

		'season_start_month' => null, // [type:integer, nullable]
		'season_start_day' => null, // [type:integer, nullable]
		'season_end_month' => null, // [type:integer, nullable]
		'season_end_day' => null, // [type:integer, nullable]

		'contact_person_name' => null, // [type:string, nullable]

		'unit_count' => 0, // [type:integer, def:0]

		'address' => null, // [type:string, nullable]

		'owner_fullname' => null, // [type:string, nullable]
	];

	protected $casts = [];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'hotel_images', 'hotel_id', 'inode_id');
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'hotel_categories', 'hotel_id', 'category_id');
	}

	public function zones()
	{
		return $this->belongsToMany(Zone::class, 'hotel_zones', 'hotel_id', 'zone_id');
	}

	public function features()
	{
		return $this->belongsToMany(Feature::class, 'hotel_features', 'hotel_id', 'feature_id');
	}

	public function rooms()
	{
		return $this->hasMany(Room::class);
	}
}
