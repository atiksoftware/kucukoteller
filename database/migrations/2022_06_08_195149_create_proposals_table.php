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
        Schema::create('proposals', function (Blueprint $table) {
			$table->id();
			$table->json('title')->default('{}');
			$table->json('slug')->default('{}');
			$table->json('brief')->default('{}');
			$table->json('content')->default('{}');
			$table->json('meta_title')->default('{}');
			$table->json('meta_description')->default('{}');
			$table->enum('type', [1, 2, 3, 4, 5, 6, 7, 8]);
			$table->foreignId('zone_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('proposals');
    }
};
