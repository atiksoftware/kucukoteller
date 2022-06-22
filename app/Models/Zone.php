<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Zone extends Model
{
	use HasTranslations;

	public $translatable = ['name', 'title', 'slug', 'brief', 'content', 'meta_title', 'meta_description'];

	protected $attributes = [
		'is_active' => true, // [type:boolean, def:true]
		'is_visible' => true, // [type:boolean, def:true]

		'parent_id' => null, // [type:integer, nullable, Model:Zone]
	];

	protected $casts = [
		'is_active' => 'boolean',
		'is_visible' => 'boolean',
		'parent_id' => 'integer',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function parent()
	{
		return $this->belongsTo(self::class, 'parent_id');
	}

	public function children()
	{
		return $this->hasMany(self::class, 'parent_id');
	}

	public function proposals()
	{
		return $this->hasMany(Proposal::class);
	}

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'zone_images', 'zone_id', 'inode_id');
	}

	public function faqs()
	{
		return $this->belongsToMany(Faq::class, 'zone_faqs', 'zone_id', 'faq_id');
	}
}
