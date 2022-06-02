<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
	use HasSlug;

	protected $attributes = [
		'name' => '', // [ type: string, required: true, max: 255 ]
		'slug' => '', // [ type: string, required: true, max: 255 ]
	];

	protected $casts = [
		'name' => 'string',
		'slug' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function getSlugOptions(): SlugOptions
	{
		return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
	}
}
