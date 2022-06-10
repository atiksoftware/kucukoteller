<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Zone extends Model
{
	use HasTranslations;

	public $translatable = ['name', 'title', 'slug', 'brief', 'content'];

	protected $attributes = [];

	protected $casts = [
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
