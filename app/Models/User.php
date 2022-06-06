<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens;
	use Notifiable;

	protected $attributes = [
		'firstname' => '', // [type: string]
		'lastname' => '', // [type: string]
		'email' => '', // [type: string, unique, index]
		'password' => '', // [type: string]
		'remember_token' => null,  // [type: string, nullable]
		'email_verified_at' => null, // [type: datetime, nullable]
		'two_factor_secret' => null, // [type: string, nullable]
		'two_factor_enabled' => false, // [type: boolean]
	];

	protected $casts = [
		'firstname' => 'string',
		'lastname' => 'string',
		'email' => 'string',
		'password' => 'string',
		'remember_token' => 'string',
		'email_verified_at' => 'datetime',
		'two_factor_secret' => 'string',
		'two_factor_enabled' => 'boolean',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function sendPasswordResetNotification($token): void
	{
		$this->notify(new ResetPassword($token));
	}

	public function sendEmailVerificationNotification(): void
	{
		$this->notify(new VerifyEmail());
	}

	public function getFullNameAttribute(): string
	{
		return $this->firstname . ' ' . $this->lastname;
	}
}
