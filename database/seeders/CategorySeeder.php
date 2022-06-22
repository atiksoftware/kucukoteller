<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	public function run(): void
	{
		Category::truncate();

		$rows = SeederHelper::getRows('categories');

		foreach ($rows as $row) {
			echo $row['title']['tr'] . "\n";
			$record = new Category();
			$record->title = $row['title'];
			$record->slug = $row['slug'];
			$record->brief = $row['slogan'];
			$record->content = $row['text'];

			$record->meta_title = $row['meta']['title'];
			$record->meta_description = $row['meta']['description'];

			$timestamp = $row['date']['edit'];
			$record->created_at = \Carbon\Carbon::createFromTimestamp($timestamp);
			$record->updated_at = \Carbon\Carbon::createFromTimestamp($timestamp);
			$record->save();
		}
	}
}
