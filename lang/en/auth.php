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
			'email' => 'Email is invalid',
		],
		'password' => [
			'required' => 'Password is required',
			'min' => 'Password must be at least :min characters',
			'max' => 'Password must be at most :max characters',
			'confirmed' => 'Password confirmation does not match',
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
];
