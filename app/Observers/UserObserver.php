<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;

class UserObserver
{
	public function creating(User $user): void
	{
		$google2fa = new Google2FA();

		$user->two_factor_secret = Str::upper(Str::random(16));
		$user->two_factor_secret = $google2fa->generateSecretKey();
		$user->two_factor_secret = 'OWBECMYBDAKXWRYG';
	}
}
