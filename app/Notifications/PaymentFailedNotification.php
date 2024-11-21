<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentFailedNotification extends Notification
{
    use Queueable;
    protected $payment;
    /**
     * Create a new notification instance.
     */
    public function __construct(
        object $payment
    ) {
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Payment Failed')
            ->greeting("Hello, {$notifiable->name}!")
            ->line('We are sorry to inform you that your payment has failed.')
            ->line('Please try again or contact support for further assistance.')
            ->action('Retry Payment', url('/payments/pay?id=' . $this->payment->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
            'payment_date' => $this->payment->payment_date,
            'course' => $this->payment->course->name,
        ];
    }
}
