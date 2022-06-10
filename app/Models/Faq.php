<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
	use HasTranslations;

	public $translatable = ['question', 'answer'];

	protected $attributes = [];

	protected $casts = [
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
