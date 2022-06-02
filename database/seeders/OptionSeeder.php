<?php

namespace Database\Seeders;

use App\Models\OptionGroup;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// clear all OptionGroup
		OptionGroup::truncate();

		// create OptionGroup
		$optionGroup = OptionGroup::create([
			'name' => _('option.api_settings'),
		]);
	}
}
