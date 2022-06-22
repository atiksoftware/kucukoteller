<?php

namespace App\Helpers;

class LocaleHelper
{
	public static function getLocaleCodes(): array
	{
		return ['tr', 'en'];
	}

	public static function getLocaleNames(): array
	{
		return [
			'tr' => 'Türkçe',
			'en' => 'English',
		];
	}

	public static function getLocaleName($code): string
	{
		if (!\in_array($code, self::getLocaleCodes(), true)) {
			return '';
		}

		return self::getLocaleNames()[$code];
	}

	public static function getLocaleCount()
	{
		return \count(self::getLocaleCodes());
	}
}
