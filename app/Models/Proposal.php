<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Proposal extends Model
{
	use HasTranslations;

	public $translatable = ['title', 'slug', 'brief', 'content'];

	protected $attributes = [
		'zone_id' => null, // [type:integer, model:Zone]
	];

	protected $casts = [
		'zone_id' => 'integer',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
