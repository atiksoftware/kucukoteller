<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

// route group its starting with /auth and its middleware is guest
Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function (): void {
	Route::get('signup', [RegisteredUserController::class, 'create'])
		->name('auth.signup');

	Route::post('signup', [RegisteredUserController::class, 'store']);

	Route::get('signin', [AuthenticatedSessionController::class, 'create'])
		->name('auth.signin');

	Route::post('signin', [AuthenticatedSessionController::class, 'store']);

	Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
		->name('auth.password.request');

	Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
		->name('auth.password.email');

	Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
		->name('auth.password.reset');

	Route::post('reset-password', [NewPasswordController::class, 'store'])
		->name('auth.password.update');
});

Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function (): void {
	Route::get('verify-email', [VerifyEmailController::class, 'show'])
		->name('auth.verify-email');

	Route::post('verify-email', [VerifyEmailController::class, 'create'])
		->name('auth.verify-email.create');

	Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
		->middleware(['signed', 'throttle:6,1'])
		->name('auth.verify-email.verify');

	Route::get('otp-setup', [OTPController::class, 'setup'])
		->name('auth.otp-setup');

	Route::post('otp-setup', [OTPController::class, 'complete'])
		->name('auth.otp-setup');

	Route::get('otp-screen', [OTPController::class, 'screen'])
		->name('auth.otp-screen');

	Route::post('otp-screen', [OTPController::class, 'verify'])
		->name('auth.otp-verify');

	// Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
	// 	->middleware('throttle:6,1')
	// 	->name('verification.send');

	// Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
	// 	->name('password.confirm');

	// Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

	Route::get('signout', [AuthenticatedSessionController::class, 'destroy'])
		->name('auth.signout');
});
