<?php

namespace App\Models;

use App\Enums\InodeType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Inode extends Model
{
	use HasTranslations;

	public $translatable = ['description'];

	protected $attributes = [
		'uuid' => '', // [type:string, length:36]
		'path' => '', // [type:string]
		'width' => 0, // [type:integer]
		'height' => 0, // [type:integer]
		'size' => 0, // [type:integer]
		'duration' => 0, // [type:integer]
		'type' => InodeType::IMAGE, // [type:integer, enum:InodeType, def:1]
	];

	protected $casts = [
		'uuid' => 'string',
		'path' => 'string',
		'width' => 'integer',
		'height' => 'integer',
		'size' => 'integer',
		'duration' => 'integer',
		'type' => InodeType::class,
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
