<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class WelcomeEmailSent extends Notification implements ShouldQueue {
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {

		//$prefix = '/confirm-registration?url=';
		$prefix = config('frontend.url') . config('frontend.email_verify_url');
		$temporarySignedURL = URL::temporarySignedRoute(
			'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
		);
		$url = $prefix . urlencode($temporarySignedURL);
		return (new MailMessage)
			->greeting('Dear ' . $notifiable->username . ',')
			->subject('Email Verification')
			->line('Please click on the link below to complete your registration.')
			->action('Verify Email', url($url))
			->line('Thank you for your time with us');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			//
		];
	}
}
