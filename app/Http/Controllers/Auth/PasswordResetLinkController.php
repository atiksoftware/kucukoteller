<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
	/**
	 * Display the password reset link request view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return view('auth.forgot-password');
	}

	/**
	 * Handle an incoming password reset link request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			// 'g-recaptcha-response' => 'required|recaptcha',
		], [
			'email.required' => __('auth.validation.email.required'),
			'email.email' => __('auth.validation.email.email'),
			'g-recaptcha-response.required' => __('auth.validation.g-recaptcha.required'),
			'g-recaptcha-response.recaptcha' => __('auth.validation.g-recaptcha.recaptcha'),
		]);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		if (Password::RESET_LINK_SENT === $status) {
			return back()->with('status', __('auth.forgot-password.email-sent'));
		}
		$errors = [];
		if (Password::INVALID_USER === $status) {
			$errors['email'] = __('auth.forgot-password.invalid-user');
		}

		return back()
			->withInput($request->only('email'))
			->withErrors($errors);
	}
}
