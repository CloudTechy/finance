<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewWithdrawalRequest extends Notification implements ShouldQueue
{
    use Queueable;
protected $withdrawal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($withdrawal) {
        $this->withdrawal = $withdrawal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $withdrawal = $this->withdrawal;
        $dashboardPath = config('frontend.url').'/admin/dashboard/withdrawals?username='.$withdrawal->user->username;
        return (new MailMessage)
            ->greeting('Dear ' . $notifiable->username . ',')
            ->subject('Withdrawal Request')
            ->line('A withdrawal request just occured ')
            ->line('This is to notify you that the user '.$withdrawal->user->username.' has indicated interest to withdraw the sum of $' . $withdrawal->amount)
            ->line('kindly review this occurence as soon as possible')
            ->action('Review', url($dashboardPath));

            
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
