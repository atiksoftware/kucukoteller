<?php

namespace App\Observers;

use App\Models\Hotel;
use App\Helpers\MetaHelper;
use Illuminate\Support\Str;

class HotelObserver
{
	public function saving(Hotel $hotel): void
	{
		if (empty($hotel->slug)) {
			$hotel->slug = Str::slug($hotel->name);
		}
		if (empty($hotel->meta_title)) {
			$hotel->meta_title = $hotel->title;
		}
		if (empty($hotel->meta_description)) {
			$hotel->meta_description = MetaHelper::getFirstSentence($hotel->content);
		}
	}
}
