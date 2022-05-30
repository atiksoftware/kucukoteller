<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens;
	use HasFactory;
	use Notifiable;

	protected $attributes = [
		'firstname' => '', // [type: string]
		'lastname' => '', // [type: string]
		'email' => '', // [type: string, unique, index]
		'password' => '', // [type: string]
		'remember_token' => null,  // [type: string, nullable]
		'email_verified_at' => null, // [type: datetime, nullable]
	];

	protected $casts = [
		'firstname' => 'string',
		'lastname' => 'string',
		'email' => 'string',
		'password' => 'string',
		'remember_token' => 'string',
		'email_verified_at' => 'datetime',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function sendPasswordResetNotification($token): void
	{
		$this->notify(new ResetPassword($token));
	}
}
