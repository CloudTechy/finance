<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionMade extends Notification implements ShouldQueue {
	use Queueable;
	protected $transaction;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($transaction) {
		$this->transaction = $transaction;
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
		$transaction = $this->transaction;
		// $dashboardPath = $notifiable->isAdmin ? '/admin/dashboard' : '/user/dashboard/';
		$dashboardPath = $notifiable->isAdmin == true ? config('frontend.url').'/admin/dashboard' : config('frontend.url').'/user/dashboard/';
		return (new MailMessage)
			->greeting('Dear ' . $notifiable->username . ',')
			->subject('Account Credited')
			->line('A credit transaction has occured in your account')
			->line('This is to notify you that a sum of $' . $transaction->amount . ' has been credited into your account')
			->action('Goto Dashboard', url($dashboardPath))
			->line('Thank you for investing with us');
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
