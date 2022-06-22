<?php

namespace App\Helpers;

class MetaHelper
{
	public static function getFirstSentence($html)
	{
		$text = strip_tags($html);
		$first_sentence = preg_split('/[.?!]/', $text, 2, PREG_SPLIT_NO_EMPTY);

		if (isset($first_sentence[0])) {
			return $first_sentence[0];
		}

		return null;
	}
}
