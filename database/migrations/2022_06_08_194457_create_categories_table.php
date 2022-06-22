<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->json('title')->default('{}');
			$table->json('slug')->default('{}');
			$table->json('brief')->default('{}');
			$table->json('content')->default('{}');
			$table->json('meta_title')->default('{}');
			$table->json('meta_description')->default('{}');
			$table->boolean('is_active')->default(true);
			$table->boolean('is_visible')->default(true);
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
