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
        Schema::create('hotels', function (Blueprint $table) {
			$table->id();
			$table->json('name')->default('{}');
			$table->json('slug')->default('{}');
			$table->json('content')->default('{}');
			$table->json('owner_welcome_text')->default('{}');
			$table->json('how_is_there_like')->default('{}');
			$table->boolean('is_active')->default(true);
			$table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
			$table->string('email')->nullable();
			$table->boolean('email_showable')->default(false);
			$table->string('phone')->nullable();
			$table->boolean('phone_showable')->default(false);
			$table->string('whatsapp')->nullable();
			$table->boolean('whatsapp_showable')->default(false);
			$table->string('website')->nullable();
			$table->boolean('website_showable')->default(false);
			$table->float('latitude')->nullable();
			$table->float('longitude')->nullable();
			$table->boolean('location_showable')->default(false);
			$table->integer('season_start_month')->nullable();
			$table->integer('season_start_day')->nullable();
			$table->integer('season_end_month')->nullable();
			$table->integer('season_end_day')->nullable();
			$table->string('contact_person_name')->nullable();
			$table->integer('unit_count');
			$table->string('address')->nullable();
			$table->string('owner_fullname')->nullable();
			$table->float('rating');
			$table->integer('call_count');
			$table->integer('reservation_count');
			$table->integer('view_count');
			$table->integer('comment_count');
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
        Schema::dropIfExists('hotels');
    }
};
