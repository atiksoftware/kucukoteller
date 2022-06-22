<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BedType extends Model
{
	use HasTranslations;

	public $translatable = ['name'];

	protected $attributes = [];

	protected $casts = [
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
