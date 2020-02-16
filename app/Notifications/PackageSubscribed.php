<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PackageSubscribed extends Notification implements ShouldQueue {
	use Queueable;
	protected $package;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($package) {
		$this->package = $package;
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
		$package = $this->package;
		$dashboardPath = $notifiable->isAdmin == true  ? config('frontend.url').'/admin/dashboard' : config('frontend.url').'/user/dashboard/';
		return (new MailMessage)
			->greeting('Dear ' . $notifiable->username . ',')
			->subject('Successful Package Subscription')
			->line('Your subscription was successful and your active account has been credited with $' . $package->deposit)
			->action('Goto Dashboard', url($dashboardPath))
			->line('Thank you for investing with us')
			->bcc('conyekelu@yahoo.com','BFIN notification');
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
