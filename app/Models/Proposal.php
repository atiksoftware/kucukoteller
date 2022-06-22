<?php

namespace App\Models;

use App\Enums\ProposalType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Proposal extends Model
{
	use HasTranslations;

	public $translatable = ['title', 'slug', 'brief', 'content', 'meta_title', 'meta_description'];

	protected $attributes = [
		'type' => ProposalType::DIRECTION, // [type:integer, def:1, enum:ProposalType]
		'zone_id' => null, // [type:integer, model:Zone]
	];

	protected $casts = [
		'type' => ProposalType::class,
		'zone_id' => 'integer',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function zone()
	{
		return $this->belongsTo(Zone::class);
	}
}
