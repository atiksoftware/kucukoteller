<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
	public function up(): void
	{
		Schema::create('category_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('category_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});

		Schema::create('zone_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('category_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});
		Schema::create('zone_faqs', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('zone_id')->constrained();
			$table->foreignId('faq_id')->constrained();
		});

		Schema::create('hotel_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('hotel_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});
		Schema::create('hotel_categories', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('hotel_id')->constrained();
			$table->foreignId('category_id')->constrained();
		});
		Schema::create('hotel_zones', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('hotel_id')->constrained();
			$table->foreignId('zone_id')->constrained();
		});
		Schema::create('hotel_features', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('hotel_id')->constrained();
			$table->foreignId('feature_id')->constrained();
		});
		Schema::create('hotel_faqs', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('hotel_id')->constrained();
			$table->foreignId('faq_id')->constrained();
		});

		Schema::create('room_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('room_id')->constrained();
			$table->foreignId('feature_id')->constrained();
		});

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

	public function down(): void
	{
		Schema::dropIfExists('category_images');

		Schema::dropIfExists('zone_images');
		Schema::dropIfExists('zone_faqs');

		Schema::dropIfExists('hotel_images');
		Schema::dropIfExists('hotel_categories');
		Schema::dropIfExists('hotel_zones');
		Schema::dropIfExists('hotel_features');
		Schema::dropIfExists('hotel_faqs');

		Schema::dropIfExists('room_images');
	}
};
