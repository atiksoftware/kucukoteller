<?php

return [
	'signin' => 'Sign In',
	'signout' => 'Sign Out',
	'signup' => 'Sign Up',
	'email' => 'Email',
	'password' => 'Password',
	'forgot_password' => 'Forgot Password',
	'reset_password' => 'Reset Password',
	'password_confirmation' => 'Password Confirmation',
	'fill_informations' => 'Enter your informations to continue',
	'create_new_account' => 'Create new account',
	'already_have_account' => 'Already have an account?',
	'dont_have_an_account' => 'Don\'t have an account?',
	'firstname' => 'Firstname',
	'lastname' => 'Lastname',
	'continue' => 'Continue',
	'verify_email' => 'Verify your email',
	'verify_email_description' => 'Please check your email to verify your account',
	'setup_two_factor_authentication' => 'Setup two factor authentication',
	'setup_two_factor_authentication_description' => 'Setup two factor authentication to increase your security',
	'two_factor_authentication' => 'Two factor authentication',
	'enter_your_google_authenticator_code' => 'Enter your Google Authenticator code',
	'or' => 'or',

	'validation' => [
		'g-recaptcha' => [
			'required' => 'Please verify that you are not a robot',
			'recaptcha' => 'Please verify that you are not a robot',
		],
		'token' => [
			'required' => 'Token is required',
			'expired' => 'Token is expired',
			'invalid' => 'Token is invalid',
		],
		'email' => [
			'required' => 'Email is required',
			'string' => 'Email must be a string',
			'email' => 'Email is invalid',
			'unique' => 'Email is already taken',
			'max' => 'Email is too long. Max :max characters',
		],
		'password' => [
			'required' => 'Password is required',
			'min' => 'Password must be at least :min characters',
			'max' => 'Password must be at most :max characters',
			'confirmed' => 'Password confirmation does not match',
		],
		'firstname' => [
			'required' => 'Firstname is required',
			'string' => 'Firstname must be a string',
			'min' => 'Firstname must be at least :min characters',
			'max' => 'Firstname must be at most :max characters',
		],
		'lastname' => [
			'required' => 'Lastname is required',
			'string' => 'Lastname must be a string',
			'min' => 'Lastname must be at least :min characters',
			'max' => 'Lastname must be at most :max characters',
		],
	],

	'forgot-password' => [
		'email-sent' => 'Password reset link has been sent to your email',
		'invalid-user' => 'The email address is not associated with any account',
		'reset-password-notification' => 'Reset Password Notification',
		'click-here-to-reset-password' => 'Click here to reset your password',
		'you-are-receiving-this-email-because-you-have-requested-a-password-reset-for-your-account' => 'You are receiving this email because you have requested a password reset for your account',
		'password-reset-link-expired' => 'This password reset link will expire in :count minutes.',
		'if-you-did-not-request-a-password-reset-no-further-action-is-required' => 'If you did not request a password reset, no further action is required.',
	],

	'verify-email' => [
		'email-not-verified' => 'Your email address is not verified. Please check your email and click the verification link.',
		'if-not-received' => 'If you did not receive the email',
		'get-new-verification-link' => 'Get a new verification link',
		'verify-email-notification' => 'Verify Email Notification',
		'please-click-on-the-link-below-to-verify-your-email-address' => 'Please click on the link below to verify your email address',
		'click-here-to-verify-email' => 'Click here to verify your email',
		'you-are-receiving-this-email-because-you-have-signed-up-for-a-new-account' => 'You are receiving this email because you have signed up for a new account',
		'if-you-did-not-sign-up-for-an-account-no-further-action-is-required' => 'If you did not sign up for an account, no further action is required.',
		'verification-link-sent' => 'Verification link sent. Please check your email.',
	],

	'otp' => [
		'scan-qr-code' => 'Scan QR Code',
		'open-as-link' => 'Open as Link',
		'i-have-scanned-qr-code' => 'I have scanned QR Code',
		'complete-setup' => 'Complete Setup',
		'invalid-code' => 'Invalid Code',
	],
];
