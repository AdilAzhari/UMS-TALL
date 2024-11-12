<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseRegistrationNotification extends Notification
{
    use Queueable;
    protected $course,$proctor_status, $requiresProctor;
    /**
     * Create a new notification instance.
     */
    public function __construct(Course $Course,$Proctor_status, $RequiresProctor)
    {
        $this->course = $Course;
        $this->proctor_status = $Proctor_status;
        $this->requiresProctor = $RequiresProctor;
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
        $courseName = $this->course->name;
        $statusMessage = $this->requiresProctor
            ? "This course requires a proctor. Please assign a proctor at your earliest convenience."
            : "No proctor is required for this course.";
        return (new MailMessage)
                ->subject("Registration Status Update for {{ $courseName }}")
                ->greeting("Hello, {$notifiable->name}!")
                ->line("Thank you for registering for **{$courseName}**.")
                ->line("Here are your registration details:")
                ->action('Notification Action', url('/'))
                ->markdown('emails.course_registration', [
                    'courseName' => $courseName,
                    'status' => $this->proctor_status,
                    'requiresProctor' => $this->requiresProctor,
                    'statusMessage' => $statusMessage,
                    'user' => $notifiable->name,
                ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            ''
        ];
    }
}
