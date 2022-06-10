<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::create('users', function (Blueprint $table): void {
			$table->id();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->index()->unique();
			$table->string('password');
			$table->string('remember_token')->nullable();
			$table->datetime('email_verified_at')->nullable();
			$table->string('two_factor_secret')->nullable();
			$table->boolean('two_factor_enabled');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('users');
	}
};
