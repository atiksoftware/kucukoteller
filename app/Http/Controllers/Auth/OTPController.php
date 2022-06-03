<?php

namespace App\Http\Controllers\Auth;

use BaconQrCode\Writer;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class OTPController extends Controller
{
	public function setup(Request $request)
	{
		$user = $request->user();

		$google2fa = new Google2FA();
		$g2faUrl = $google2fa->getQRCodeUrl(
			config('app.name'),
			$user->email,
			$user->two_factor_secret
		);

		$writer = new Writer(
			new ImageRenderer(
				new RendererStyle(240),
				new SvgImageBackEnd()
			)
		);

		$image_svg = $writer->writeString($g2faUrl);

		return view('auth.otp-setup', [
			'image_svg' => $image_svg,
			'otp_url' => $g2faUrl,
		]);
	}

	public function complete(Request $request)
	{
		$user = $request->user();
		$user->two_factor_enabled = true;
		$user->save();

		return redirect()->route('auth.otp-screen');
	}

	public function screen(Request $request)
	{
		return view('auth.otp-screen');
	}

	public function verify(Request $request)
	{
		$this->validate($request, [
			'otp_password' => ['required'],
		], [
			'otp_password.required' => __('auth.validation.password.required'),
		]);

		$user = $request->user();
		$password = $request->input('otp_password');

		$google2fa = new Google2FA();

		$valid = $google2fa->verifyKey($user->two_factor_secret, $password, 8);

		if ($valid) {
			$request->session()->put('otp_verified', true);

			return redirect()->intended(RouteServiceProvider::HOME);
		}

		return back()->withErrors([
			'otp_password' => __('auth.otp.invalid-code'),
		]);
	}
}
