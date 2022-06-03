<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
	public function create()
	{
		return view('auth.signup');
	}

	public function store(Request $request)
	{
		$min = 8;
		$max = 64;
		$rules = new Rules\Password($min);

		$this->validate($request, [
			'firstname' => ['required', 'string', 'max:' . $max],
			'lastname' => ['required', 'string', 'max:' . $max],
			'email' => ['required', 'email', 'max:' . $max, 'unique:users'],
			'password' => ['required', 'min:' . $min, 'confirmed', $rules],
			'password' => 'required|string|min:6|confirmed',
			'g-recaptcha-response' => ['required', 'recaptcha'],
		], [
			'firstname.required' => __('auth.validation.firstname.required'),
			'firstname.string' => __('auth.validation.firstname.string'),
			'firstname.max' => __('auth.validation.firstname.max'),
			'lastname.required' => __('auth.validation.lastname.required'),
			'lastname.string' => __('auth.validation.lastname.string'),
			'lastname.max' => __('auth.validation.lastname.max'),
			'email.required' => __('auth.validation.email.required'),
			'email.string' => __('auth.validation.email.string'),
			'email.email' => __('auth.validation.email.email'),
			'email.max' => __('auth.validation.email.max'),
			'email.unique' => __('auth.validation.email.unique'),
			'password.required' => __('auth.validation.password.required'),
			'password.confirmed' => __('auth.validation.password.confirmed'),
			'g-recaptcha.required' => __('auth.validation.recaptcha.required'),
			'g-recaptcha.recaptcha' => __('auth.validation.recaptcha.recaptcha'),
		]);

		$user = User::create([
			'firstname' => $request->firstname,
			'lastname' => $request->lastname,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		event(new Registered($user));

		Auth::login($user);

		return redirect()->route('profile');
	}
}
