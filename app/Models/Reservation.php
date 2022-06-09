<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	protected $attributes = [
		'hotel_id' => null, // [type:integer, model:Hotel]
		'room_id' => null, // [type:integer, model:Room]

		'fullname' => '', // [type:string, length:64]
		'email' => '', // [type:string, length:64]
		'phone' => '', // [type:string, length:64]

		'checkin_date' => '', // [type:date, length:64]
		'checkout_date' => '', // [type:date, length:64]
		'night_count' => 0, // [type:integer]

		'adults' => 0, // [type:integer]
		'children' => 0, // [type:integer]
		'children_ages' => null, // [type:string, nullable, length:64]

		'extra_bed' => false, // [type:boolean]

		'total_price' => 0, // [type:float]

		'note' => '', // [type:string, dbType:text]

		'ip_address' => '', // [type:string, length:64]
		'user_agent' => '', // [type:string, length:255]
	];

	protected $casts = [];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function hotel()
	{
		return $this->belongsTo(Hotel::class);
	}

	public function room()
	{
		return $this->belongsTo(Room::class);
	}
}
