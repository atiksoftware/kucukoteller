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
		'user_id' => null, // [type:integer, model:User, nullable]

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

		'rating' => 0, // [type:float, def:0]

		'call_count' => 0, // [type:integer, def:0]
		'reservation_count' => 0, // [type:integer, def:0]
		'view_count' => 0, // [type:integer, def:0]
		'comment_count' => 0, // [type:integer, def:0]
	];

	protected $casts = [
		'is_active' => 'boolean',
		'user_id' => 'integer',
		'email' => 'string',
		'email_showable' => 'boolean',
		'phone' => 'string',
		'phone_showable' => 'boolean',
		'whatsapp' => 'string',
		'whatsapp_showable' => 'boolean',
		'website' => 'string',
		'website_showable' => 'boolean',
		'latitude' => 'float',
		'longitude' => 'float',
		'location_showable' => 'boolean',
		'season_start_month' => 'integer',
		'season_start_day' => 'integer',
		'season_end_month' => 'integer',
		'season_end_day' => 'integer',
		'contact_person_name' => 'string',
		'unit_count' => 'integer',
		'address' => 'string',
		'owner_fullname' => 'string',
		'rating' => 'float',
		'call_count' => 'integer',
		'reservation_count' => 'integer',
		'view_count' => 'integer',
		'comment_count' => 'integer',
	];

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
