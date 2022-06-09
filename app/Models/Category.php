<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
	use HasTranslations;

	public $translatable = ['title', 'slug', 'brief', 'content'];

	protected $attributes = [
		'is_active' => true, // [type:boolean, def:true]
	];

	protected $casts = [];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'category_images', 'category_id', 'inode_id');
	}
}
