<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// route group its starting with /auth and its middleware is guest
Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function (): void {
	Route::get('signup', [RegisteredUserController::class, 'create'])
		->name('signup');

	Route::post('signup', [RegisteredUserController::class, 'store']);

	Route::get('signin', [AuthenticatedSessionController::class, 'create'])
		->name('signin');

	Route::post('signin', [AuthenticatedSessionController::class, 'store']);

	Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
		->name('password.request');

	Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
		->name('password.email');

	Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
		->name('password.reset');

	Route::post('reset-password', [NewPasswordController::class, 'store'])
		->name('password.update');
});

Route::middleware('auth')->group(function (): void {
	Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
		->name('verification.notice');

	Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
		->middleware(['signed', 'throttle:6,1'])
		->name('verification.verify');

	Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
		->middleware('throttle:6,1')
		->name('verification.send');

	Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
		->name('password.confirm');

	Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

	Route::get('signout', [AuthenticatedSessionController::class, 'destroy'])
		->name('signout');
});
