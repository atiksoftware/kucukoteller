<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{
	/**
	 * The callback that should be used to create the verify email URL.
	 *
	 * @var null|\Closure
	 */
	public static $createUrlCallback;

	/**
	 * The callback that should be used to build the mail message.
	 *
	 * @var null|\Closure
	 */
	public static $toMailCallback;

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
		$verificationUrl = $this->verificationUrl($notifiable);

		if (static::$toMailCallback) {
			return \call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
		}

		return $this->buildMailMessage($verificationUrl);
	}

	/**
	 * Get the verify email notification mail message for the given URL.
	 *
	 * @param string $url
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	protected function buildMailMessage($url)
	{
		return (new MailMessage())
			->subject(__('auth.verify-email.verify-email-notification'))
			->line(__('auth.verify-email.please-click-on-the-link-below-to-verify-your-email-address'))
			->action(__('auth.verify-email.click-here-to-verify-email'), $url)
			->line(__('auth.verify-email.you-are-receiving-this-email-because-you-have-signed-up-for-a-new-account'))
			->line(__('auth.verify-email.if-you-did-not-sign-up-for-an-account-no-further-action-is-required'));
	}

	/**
	 * Get the verification URL for the given notifiable.
	 *
	 * @param mixed $notifiable
	 *
	 * @return string
	 */
	protected function verificationUrl($notifiable)
	{
		if (static::$createUrlCallback) {
			return \call_user_func(static::$createUrlCallback, $notifiable);
		}

		return URL::temporarySignedRoute(
			'auth.verify-email.verify',
			Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
			[
				'id' => $notifiable->getKey(),
				'hash' => sha1($notifiable->getEmailForVerification()),
			]
		);
	}

	/**
	 * Set a callback that should be used when creating the email verification URL.
	 *
	 * @param \Closure $callback
	 */
	public static function createUrlUsing($callback): void
	{
		static::$createUrlCallback = $callback;
	}

	/**
	 * Set a callback that should be used when building the notification mail message.
	 *
	 * @param \Closure $callback
	 */
	public static function toMailUsing($callback): void
	{
		static::$toMailCallback = $callback;
	}
}
