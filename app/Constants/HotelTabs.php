<?php

namespace App\Constants;

use App\Models\Hotel;
use Illuminate\Support\Facades\Route;

class HotelTabs
{
	public static function keys(): array
	{
		return [
			'informations',
			'general',
			'categories',
			'features',
			'gallery',
			'rooms',
			'pricing',
			'comments',
			'owner',
			'reservations',
			'faq',
		];
	}

	public static function tabs(Hotel $hotel)
	{
		foreach (self::keys() as $key) {
			$route_name = 'dashboard.hotel.' . $key . '.edit';
			yield [
				'key' => $key,
				'label' => __('dashboard.hotel_tabs.' . $key),
				'link' => Route::has($route_name) ? route($route_name, ['hotel' => $hotel]) : '#',
			];
		}
	}
}
