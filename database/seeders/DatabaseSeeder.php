<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		// \App\Models\User::factory(10)->create();

		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);
		User::truncate();

		User::create([
			'firstname' => 'Mansur',
			'lastname' => 'Atik',
			'email' => 'atiksoftware@gmail.com',
			'password' => Hash::make('password'),
		]);

		// call OptionSeeder
		// $this->call(OptionSeeder::class);
		$this->call(CategorySeeder::class);
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
