<?php

namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;

class Authenticate implements AuthenticatesRequests
{
	/**
	 * The authentication factory instance.
	 *
	 * @var \Illuminate\Contracts\Auth\Factory
	 */
	protected $auth;

	/**
	 * Create a new middleware instance.
	 */
	public function __construct(Auth $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param string[]                 ...$guards
	 *
	 * @throws \Illuminate\Auth\AuthenticationException
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next, ...$guards)
	{
		$this->authenticate($request, $guards);

		$this->ensureAll($request, $guards);

		return $next($request);
	}

	/**
	 * Determine if the user is logged in to any of the given guards.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @throws \Illuminate\Auth\AuthenticationException
	 */
	protected function authenticate($request, array $guards)
	{
		if (empty($guards)) {
			$guards = [null];
		}

		foreach ($guards as $guard) {
			if ($this->auth->guard($guard)->check()) {
				return $this->auth->shouldUse($guard);
			}
		}

		$this->unauthenticated($request, $guards);
	}

	/**
	 * Handle an unauthenticated user.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @throws \Illuminate\Auth\AuthenticationException
	 */
	protected function unauthenticated($request, array $guards): void
	{
		throw new AuthenticationException(
			'Unauthenticated.',
			$guards,
			$this->redirectTo($request, route('auth.signin'))
		);
	}

	/**
	 * Get the path the user should be redirected to when they are not authenticated.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param mixed                    $route
	 *
	 * @return null|string
	 */
	protected function redirectTo($request, $route)
	{
		if (!$request->expectsJson()) {
			return $route;

			return route('auth.signin');
		}
	}

	protected function ensureAll($request, array $guards): void
	{
		$user = $request->user();

		if (!$user) {
			$this->unauthenticated($request, $guards);
		}

		// if (!$user->hasVerifiedEmail()) {
		// 	if (0 === strpos($request->url(), route('auth.verify-email'))) {
		// 		return;
		// 	}
		// 	throw new AuthenticationException('Unauthenticated.', $guards, $this->redirectTo($request, route('auth.verify-email')));
		// }
		if (env('OTP_REQUIRED')) {
			if (!$user->two_factor_enabled) {
				if (0 !== strpos($request->url(), route('auth.otp-setup'))) {
					throw new AuthenticationException('Unauthenticated.', $guards, $this->redirectTo($request, route('auth.otp-setup')));
				}
			} else {
				$otp_verified = false;
				if ($request->session()->has('otp_verified')) {
					$otp_verified = $request->session()->get('otp_verified');
				}
				if (!$otp_verified && 0 !== strpos($request->url(), route('auth.otp-screen'))) {
					throw new AuthenticationException('Unauthenticated.', $guards, $this->redirectTo($request, route('auth.otp-screen')));
				}
			}
		}
	}
}
