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
        Schema::create('reservations', function (Blueprint $table) {
			$table->id();
			$table->foreignId('hotel_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
			$table->foreignId('room_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
			$table->string('fullname', 64);
			$table->string('email', 64);
			$table->string('phone', 64);
			$table->date('checkin_date', 64);
			$table->date('checkout_date', 64);
			$table->integer('night_count');
			$table->integer('adults');
			$table->integer('children');
			$table->string('children_ages', 64)->nullable();
			$table->boolean('extra_bed');
			$table->float('total_price');
			$table->text('note');
			$table->string('ip_address', 64);
			$table->string('user_agent', 255);
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
        Schema::dropIfExists('reservations');
    }
};
