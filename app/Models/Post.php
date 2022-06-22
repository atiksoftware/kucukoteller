<?php

namespace App\Models;

use App\Enums\PostType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
	use HasTranslations;

	public $translatable = ['name', 'slug', 'brief',  'content'];

	protected $attributes = [
		'is_active' => true, // [type:boolean, def:true]
		'is_visible' => true, // [type:boolean, def:true]

		'type' => PostType::BLOG, // [type:integer, enum:PostType, def:1]
	];

	protected $casts = [
		'is_active' => 'boolean',
		'is_visible' => 'boolean',
		'type' => PostType::class,
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
