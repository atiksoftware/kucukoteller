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
			$table->json('how_to_go')->default('{}');
			$table->json('meta_title')->default('{}');
			$table->json('meta_description')->default('{}');
			$table->boolean('is_active')->default(true);
			$table->boolean('is_visible')->default(true);
			$table->boolean('is_priority')->default(false);
			$table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
			$table->foreignId('zone_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
			$table->string('email')->nullable();
			$table->boolean('email_viewable')->default(false);
			$table->string('phone')->nullable();
			$table->boolean('phone_viewable')->default(false);
			$table->string('whatsapp')->nullable();
			$table->boolean('whatsapp_viewable')->default(false);
			$table->string('website')->nullable();
			$table->boolean('website_viewable')->default(false);
			$table->float('latitude')->nullable();
			$table->float('longitude')->nullable();
			$table->boolean('location_viewable')->default(false);
			$table->boolean('season_always')->default(false);
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
			$table->string('currency')->nullable()->default('EUR');
			$table->boolean('sea_exists')->default(false);
			$table->string('sea_name')->nullable();
			$table->float('sea_distance')->nullable();
			$table->string('sea_distance_unit')->nullable()->default('km');
			$table->boolean('airport_exists')->default(false);
			$table->string('airport_name')->nullable();
			$table->float('airport_distance')->nullable();
			$table->string('airport_distance_unit')->nullable()->default('km');
			$table->boolean('citycenter_exists')->default(false);
			$table->string('citycenter_name')->nullable();
			$table->float('citycenter_distance')->nullable();
			$table->string('citycenter_distance_unit')->nullable()->default('km');
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
