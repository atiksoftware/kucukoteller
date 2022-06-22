<?php

namespace App\Constants;

class PriceEffect
{
	public static function getUnitOptionText($name)
	{
		return __('dashboard.price_effect_unit_names.' . $name);
	}

	public static function getUnitOptions()
	{
		foreach (\App\Enums\PriceEffect::cases() as $effect) {
			yield (object) [
				'value' => $effect->value,
				'text' => self::getUnitOptionText($effect->name),
			];
		}
	}
}
