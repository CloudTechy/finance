<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class NewPauseWithdrawalRequest extends Notification implements ShouldQueue
{
    use Queueable;
    protected $withdrawDuration;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($withdrawDuration) {
        $this->withdrawDuration = $withdrawDuration;
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
        $withdrawDuration = $this->withdrawDuration;
        $withdrawEx = Carbon::createFromTimeStamp(strtotime($withdrawDuration->expiration))->diffForHumans() ;
        return (new MailMessage)
            ->greeting('Dear ' . $notifiable->username . ',')
            ->subject('A User Withdrawal was put On-Hold')
            ->line('A User Withdrawal has been put On-Hold')
            ->line('This is to notify you that the user '.$withdrawDuration->user->username.' has successfully put his/her account on hold and can be able to withdraw '.$withdrawEx )
            ->line('Have a great day!!!');
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
