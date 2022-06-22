<?php

namespace Database\Seeders;

use App\Models\BedType;
use Illuminate\Database\Seeder;

class BedTypeSeeder extends Seeder
{
	public function run(): void
	{
		BedType::create(['name' => ['tr' => 'Tek Yatak', 'en' => 'Single Bed']]);
		BedType::create(['name' => ['tr' => 'Büyük Yatak', 'en' => 'Double Bed']]);
		BedType::create(['name' => ['tr' => '2+1 Yatak', 'en' => '2+1 Bed']]);
		BedType::create(['name' => ['tr' => 'Ranza', 'en' => 'Runk Bed']]);
		BedType::create(['name' => ['tr' => 'Çekyat', 'en' => 'Sofa Bed']]);
		BedType::create(['name' => ['tr' => '2+2 Yatak', 'en' => '2+2 Bed']]);
		BedType::create(['name' => ['tr' => '2+3 Yatak', 'en' => '2+3 Bed']]);
		BedType::create(['name' => ['tr' => 'İki Tekli Yatak', 'en' => 'Twin Bed']]);
		BedType::create(['name' => ['tr' => 'Geniş Çift Yatak', 'en' => 'Large Double Bed']]);
		BedType::create(['name' => ['tr' => 'Ekstra Çift Yatak', 'en' => 'King  Double Bed']]);
		BedType::create(['name' => ['tr' => 'Japon Şiltesi', 'en' => 'Futon Mat']]);
		BedType::create(['name' => ['tr' => 'Gulet', 'en' => 'Gulet']]);
		BedType::create(['name' => ['tr' => 'Tekne', 'en' => 'Boat']]);
	}
}
