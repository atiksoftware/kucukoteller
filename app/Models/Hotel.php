<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Hotel extends Model
{
	use HasTranslations;

	public $translatable = [
		'name',
		'slug',
		'content',
		'owner_welcome_text',
		'how_is_there_like',
		'how_to_go',
		'meta_title',
		'meta_description',
	];

	protected $attributes = [
		'is_active' => true, // [type:boolean, def:true]
		'is_visible' => true, // [type:boolean, def:true]
		'is_priority' => true, // [type:boolean, def:false]
		'user_id' => null, // [type:integer, model:User, nullable]

		'zone_id' => null, // [type:integer, model:Zone, nullable]

		'email' => null, // [type:string, nullable]
		'email_viewable' => false, // [type:boolean, def:false]
		'phone' => null, // [type:string, nullable]
		'phone_viewable' => false, // [type:boolean, def:false]
		'whatsapp' => null, // [type:string, nullable]
		'whatsapp_viewable' => false, // [type:boolean, def:false]
		'website' => null, // [type:string, nullable]
		'website_viewable' => false, // [type:boolean, def:false]
		'latitude' => null, // [type:float, nullable]
		'longitude' => null, // [type:float, nullable]
		'location_viewable' => false, // [type:boolean, def:false]

		'season_always' => false, // [type:boolean, def:false]
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

		'currency' => 'EUR', // [type:string, nullable, def:EUR]

		'sea_exists' => false, // [type:boolean, def:false]
		'sea_name' => null, // [type:string, nullable]
		'sea_distance' => null, // [type:float, nullable]
		'sea_distance_unit' => 'km', // [type:string, nullable, def:km]
		'airport_exists' => false, // [type:boolean, def:false]
		'airport_name' => null, // [type:string, nullable]
		'airport_distance' => null, // [type:float, nullable]
		'airport_distance_unit' => 'km', // [type:string, nullable, def:km]
		'citycenter_exists' => false, // [type:boolean, def:false]
		'citycenter_name' => null, // [type:string, nullable]
		'citycenter_distance' => null, // [type:float, nullable]
		'citycenter_distance_unit' => 'km', // [type:string, nullable, def:km]
	];

	protected $casts = [
		'is_active' => 'boolean',
		'is_visible' => 'boolean',
		'is_priority' => 'boolean',
		'user_id' => 'integer',
		'zone_id' => 'integer',
		'email' => 'string',
		'email_viewable' => 'boolean',
		'phone' => 'string',
		'phone_viewable' => 'boolean',
		'whatsapp' => 'string',
		'whatsapp_viewable' => 'boolean',
		'website' => 'string',
		'website_viewable' => 'boolean',
		'latitude' => 'float',
		'longitude' => 'float',
		'location_viewable' => 'boolean',
		'season_always' => 'boolean',
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
		'currency' => 'string',
		'sea_exists' => 'boolean',
		'sea_name' => 'string',
		'sea_distance' => 'float',
		'sea_distance_unit' => 'string',
		'airport_exists' => 'boolean',
		'airport_name' => 'string',
		'airport_distance' => 'float',
		'airport_distance_unit' => 'string',
		'citycenter_exists' => 'boolean',
		'citycenter_name' => 'string',
		'citycenter_distance' => 'float',
		'citycenter_distance_unit' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'hotel_images', 'hotel_id', 'inode_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'hotel_categories', 'hotel_id', 'category_id');
	}

	public function zone()
	{
		return $this->belongsTo(Zone::class);
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

	public function faqs()
	{
		return $this->belongsToMany(Faq::class, 'hotel_faqs', 'hotel_id', 'faq_id');
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
