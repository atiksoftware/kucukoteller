<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends Notification
{
	/**
	 * The password reset token.
	 *
	 * @var string
	 */
	public $token;

	/**
	 * The callback that should be used to create the reset password URL.
	 *
	 * @var (\Closure(mixed, string): string)|null
	 */
	public static $createUrlCallback;

	/**
	 * The callback that should be used to build the mail message.
	 *
	 * @var (\Closure(mixed, string): \Illuminate\Notifications\Messages\MailMessage)|null
	 */
	public static $toMailCallback;

	/**
	 * Create a notification instance.
	 *
	 * @param string $token
	 */
	public function __construct($token)
	{
		$this->token = $token;
	}

	/**
	 * Get the notification's channels.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array|string
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Build the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		if (static::$toMailCallback) {
			return \call_user_func(static::$toMailCallback, $notifiable, $this->token);
		}

		return $this->buildMailMessage($this->resetUrl($notifiable));
	}

	/**
	 * Get the reset password notification mail message for the given URL.
	 *
	 * @param string $url
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	protected function buildMailMessage($url)
	{
		return (new MailMessage())
			// ->subject(Lang::get('Reset Password Notification'))
			->subject(__('auth.forgot-password.reset-password-notification'))
			// ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
			->line(__('auth.forgot-password.you-are-receiving-this-email-because-you-have-requested-a-password-reset-for-your-account'))
			// ->action(Lang::get('Reset Password'), $url)
			->action(__('auth.forgot-password.click-here-to-reset-password'), $url)
			->line(__('auth.forgot-password.password-reset-link-expired', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
			->line(__('auth.forgot-password.if-you-did-not-request-a-password-reset-no-further-action-is-required'));
	}

	/**
	 * Get the reset URL for the given notifiable.
	 *
	 * @param mixed $notifiable
	 *
	 * @return string
	 */
	protected function resetUrl($notifiable)
	{
		if (static::$createUrlCallback) {
			return \call_user_func(static::$createUrlCallback, $notifiable, $this->token);
		}

		return url(route('auth.password.reset', [
			'token' => $this->token,
			'email' => $notifiable->getEmailForPasswordReset(),
		], false));
	}

	/**
	 * Set a callback that should be used when creating the reset password button URL.
	 *
	 * @param  \Closure(mixed, string): string  $callback
	 */
	public static function createUrlUsing($callback): void
	{
		static::$createUrlCallback = $callback;
	}

	/**
	 * Set a callback that should be used when building the notification mail message.
	 *
	 * @param  \Closure(mixed, string): \Illuminate\Notifications\Messages\MailMessage  $callback
	 */
	public static function toMailUsing($callback): void
	{
		static::$toMailCallback = $callback;
	}

	// public function toDatabase($notifiable)
	// {
	// 	return [
	// 		'message' => 'heeft een reactie geplaatst op een van je tickets',
	// 	];
	// }
}
