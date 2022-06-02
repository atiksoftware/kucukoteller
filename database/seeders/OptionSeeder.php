<?php

namespace Database\Seeders;

use App\Models\Option;
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

		$option = Option::create([
			'key' => 'google_recaptcha_site_key',
			'value' => '6LcRaTMgAAAAAKlFkpLtSLzD9vzLuEoTAK6VKzmw',
			'option_group_id' => $optionGroup->id,
			'title' => _('option.google_recaptcha_site_key'),
		]);

		$option = Option::create([
			'key' => 'google_recaptcha_secret_key',
			'value' => '6LcRaTMgAAAAAMaZNCmMNbpebKCoQkOUcgSPAqSF',
			'option_group_id' => $optionGroup->id,
			'title' => _('option.google_recaptcha_secret_key'),
		]);

		$option = Option::create([
			'key' => 'smtp_host',
			'value' => 'in-v3.mailjet.com',
			'option_group_id' => $optionGroup->id,
			'title' => _('option.smtp_host'),
		]);
		$option = Option::create([
			'key' => 'smtp_port',
			'value' => 587,
			'type' => 'integer',
			'option_group_id' => $optionGroup->id,
			'title' => _('option.smtp_port'),
		]);
		$option = Option::create([
			'key' => 'smtp_username',
			'value' => 'fe4d1c41cf38dbc693a32672bf26c758',
			'option_group_id' => $optionGroup->id,
			'title' => _('option.smtp_username'),
		]);
		$option = Option::create([
			'key' => 'smtp_password',
			'value' => '6e40f6e7f8f57401e3278eb1913d810d',
			'option_group_id' => $optionGroup->id,
			'title' => _('option.smtp_password'),
		]);
		$option = Option::create([
			'key' => 'smtp_protocol',
			'value' => '',
			'option_group_id' => $optionGroup->id,
			'title' => _('option.smtp_protocol'),
			'description' => _('option.smtp_protocol_description'),
		]);
	}
}
