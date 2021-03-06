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
        Schema::create('rooms', function (Blueprint $table) {
			$table->id();
			$table->json('name')->default('{}');
			$table->json('description')->default('{}');
			$table->foreignId('hotel_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
			$table->foreignId('bed_type_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
			$table->integer('size');
			$table->integer('capacity');
			$table->integer('children_allowed');
			$table->float('price_effect');
			$table->enum('price_effect_unit', [1, 2]);
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
        Schema::dropIfExists('rooms');
    }
};
