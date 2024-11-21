<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessNotification extends Notification
{
    use Queueable;
    protected $payment;
    /**
     * Create a new notification instance.
     */
    public function __construct(
        object $payment
    )
    {
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
        $courseName = $this->payment->course->name ?? 'Unknown Course';
        $amount = $this->payment->amount ?? 'N/A';
        $paymentDate = $this->payment->payment_date->format('F j, Y, g:i a') ?? 'Unknown Date';
        $method = $this->payment->method ?? 'Unknown Method';
        $transactionType = $this->payment->transaction_type ?? 'Unknown Type';
        $status = $this->payment->status ?? 'Unknown Status';
        // dd($courseName, $amount, $paymentDate, $method, $transactionType, $status);
        return (new MailMessage)
            ->subject('Payment Successful')
            ->greeting("Hello, {$notifiable->name}!")
            ->line('We are pleased to inform you that your payment has been successfully processed for the course ' . $courseName)
            ->line('Amount: $' . $amount)
            ->line('Payment Date: ' . $paymentDate)
            ->line('Payment Method: ' . $method)
            ->line('Transaction Type: ' . $transactionType)
            ->line('Status: ' . $status)
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
        ];
    }
}
