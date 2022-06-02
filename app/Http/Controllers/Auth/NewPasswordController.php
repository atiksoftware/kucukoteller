<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
	public function create(Request $request)
	{
		return view('auth.reset-password', ['request' => $request]);
	}

	public function store(Request $request)
	{
		$min = 8;
		$rules = new Rules\Password($min);

		$this->validate($request, [
			'token' => ['required'],
			'email' => ['required', 'email'],
			'password' => ['required', 'min:' . $min, 'confirmed', $rules],
		], [
			'token.required' => __('auth.validation.token.required'),
			'email.required' => __('auth.validation.email.required'),
			'email.email' => __('auth.validation.email.email'),
			'password.required' => __('auth.validation.password.required'),
			'password.min' => __('auth.validation.password.min', ['min' => $min]),
			'password.confirmed' => __('auth.validation.password.confirmed'),
		]);

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user) use ($request): void {
				$user->forceFill([
					'password' => Hash::make($request->password),
					'remember_token' => Str::random(60),
				])->save();

				event(new PasswordReset($user));
			}
		);

		if (Password::PASSWORD_RESET === $status) {
			return redirect()->route('auth.signin')->with('status', __($status));
		}

		return back()
			->withInput($request->only('email'))
			->withErrors([
				'email' => __($status),
			]);
	}
}
