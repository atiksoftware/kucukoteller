<?php

namespace App\Constants;

class HotelDistances
{
	public static function seaExistsOptions(): array
	{
		return [
			(object) [
				'value' => false,
				'text' => __('dashboard.there_is_no_sea_here'),
			],
			(object) [
				'value' => true,
				'text' => __('dashboard.there_is_a_sea_here'),
			],
		];
	}

	public static function airportExistsOptions(): array
	{
		return [
			(object) [
				'value' => false,
				'text' => __('dashboard.there_is_no_airport_here'),
			],
			(object) [
				'value' => true,
				'text' => __('dashboard.there_is_a_airport_here'),
			],
		];
	}

	public static function citycenterExistsOptions(): array
	{
		return [
			(object) [
				'value' => false,
				'text' => __('dashboard.there_is_no_citycenter_here'),
			],
			(object) [
				'value' => true,
				'text' => __('dashboard.there_is_a_citycenter_here'),
			],
		];
	}

	public static function distanceUnitOptions(): array
	{
		return [
			(object) [
				'value' => 'm',
				'text' => __('dashboard.metres'),
			],
			(object) [
				'value' => 'km',
				'text' => __('dashboard.kilometers'),
			],
		];
	}
}
