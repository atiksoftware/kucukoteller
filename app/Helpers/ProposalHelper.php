<?php

namespace App\Helpers;

use App\Models\Proposal;
use App\Enums\ProposalType;
use Atiksoftware\Gramer\Iyelik;

class ProposalHelper
{
	public static function getLangCodes(): array
	{
		return ['tr', 'en'];
	}

	public static function getValidConverts($converts): array
	{
		$list = [];
		foreach ($converts as $key => $value) {
			if (\in_array($key, self::getLangCodes(), true)) {
				$list[$key] = $value;
			}
		}

		return $list;
	}

	public static function fillTitle(Proposal $proposal): void
	{
		if (ProposalType::DIRECTION === $proposal->type) {
			$proposal->title = self::getValidConverts([
				'tr' => Iyelik::Ek($proposal->zone->getTranslation('name', 'tr'), 'e') . ' Nasıl Gidilir?',
				'en' => 'How to go to ' . $proposal->zone->getTranslation('name', 'en') . '?',
			]);
		}
		if (ProposalType::EAT === $proposal->type) {
			$proposal->title = self::getValidConverts([
				'tr' => Iyelik::Ek($proposal->zone->getTranslation('name', 'tr'), 'de') . ' Ne Yenir?',
				'en' => 'What to eat in ' . $proposal->zone->getTranslation('name', 'en') . '?',
			]);
		}
		if (ProposalType::GUIDE === $proposal->type) {
			$proposal->title = self::getValidConverts([
				'tr' => $proposal->zone->getTranslation('name', 'tr') . ' Rehberi',
				'en' => $proposal->zone->getTranslation('name', 'en') . ' Guide',
			]);
		}
		if (ProposalType::PLACES === $proposal->type) {
			$proposal->title = self::getValidConverts([
				'tr' => Iyelik::Ek($proposal->zone->getTranslation('name', 'tr'), 'de') . ' Gezilecek Yerler',
				'en' => 'Where to go in ' . $proposal->zone->getTranslation('name', 'en'),
			]);
		}
		if (ProposalType::TODO === $proposal->type) {
			$proposal->title = self::getValidConverts([
				'tr' => Iyelik::Ek($proposal->zone->getTranslation('name', 'tr'), 'de') . ' Ne Yapılır?',
				'en' => 'What to do in ' . $proposal->zone->getTranslation('name', 'en') . '?',
			]);
		}
		if (ProposalType::TAKE === $proposal->type) {
			$proposal->title = self::getValidConverts([
				'tr' => Iyelik::Ek($proposal->zone->getTranslation('name', 'tr'), 'den') . ' Ne Alınır?',
				'en' => 'What to buy in ' . $proposal->zone->getTranslation('name', 'en') . '?',
			]);
		}
		if (ProposalType::BOUTIQUE === $proposal->type) {
			$proposal->title = self::getValidConverts([
				'tr' => $proposal->zone->getTranslation('name', 'tr') . ' Butik Otelleri ve Küçük Otelleri',
				'en' => $proposal->zone->getTranslation('name', 'en') . ' Boutique Small Hotels',
			]);
		}
		if (ProposalType::BOUTIQUE === $proposal->type) {
			$proposal->title = self::getValidConverts([
				'tr' => $proposal->zone->getTranslation('name', 'tr') . ' Otel Fiyatları',
				'en' => 'Hotel Prices in ' . $proposal->zone->getTranslation('name', 'en'),
			]);
		}
	}
}
