<?php

namespace Database\Seeders;

class SeederHelper
{
	public static function getCollectionFilePath($collection_name)
	{
		// get file path from storage/mongodb/$collection_name.json
		return storage_path('mongodb/' . $collection_name . '.json');
	}

	public static function getRows($collection_name)
	{
		// get file path from storage/mongodb/$collection_name.json
		$file_path = self::getCollectionFilePath($collection_name);

		return json_decode(file_get_contents($file_path), true);
	}
}
