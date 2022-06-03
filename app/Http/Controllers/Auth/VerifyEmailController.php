<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
	public function show(Request $request)
	{
		return view('auth.verify-email');
	}

	public function create(Request $request)
	{
		if ($request->user()->hasVerifiedEmail()) {
			return redirect()->intended(RouteServiceProvider::HOME);
		}

		$this->validate($request, [
			'g-recaptcha-response' => 'required|recaptcha',
		], [
			'g-recaptcha.required' => __('auth.validation.recaptcha.required'),
			'g-recaptcha.recaptcha' => __('auth.validation.recaptcha.recaptcha'),
		]);

		$request->user()->sendEmailVerificationNotification();

		return back()->with('status', __('auth.verify-email.verification-link-sent'));
	}

	/**
	 * Mark the authenticated user's email address as verified.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function __invoke(EmailVerificationRequest $request)
	{
		if ($request->user()->hasVerifiedEmail()) {
			return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
		}

		if ($request->user()->markEmailAsVerified()) {
			event(new Verified($request->user()));
		}

		return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
	}
}
