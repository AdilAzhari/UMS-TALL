<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class AssignProctorNotification extends Notification
{
    protected $course;
    protected $proctor;

    public function __construct($course, $proctor)
    {
        $this->course = $course;
        $this->proctor = $proctor;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Generate signed URLs for acceptance and decline
        $acceptUrl = URL::signedRoute('proctor.response', [
            'proctor' => $this->proctor->id,
            'response' => 'approved'
        ]);

        $declineUrl = URL::signedRoute('proctor.response', [
            'proctor' => $this->proctor->id,
            'response' => 'rejected'
        ]);

        return (new MailMessage)
            ->subject('Proctor Assignment for ' . $this->course->name)
            ->greeting('Hello ' . $this->proctor->name . ',')
            ->line('You have been assigned as a proctor for the course: ' . $this->course->name . '.')
            ->line('If you agree to take on this role, please click the link below to accept:')
            ->action('Accept Assignment', $acceptUrl)
            ->line('If you wish to decline, please click the link below:')
            ->action('Decline Assignment', $declineUrl)
            ->line('Thank you for your response!');
    }
}
