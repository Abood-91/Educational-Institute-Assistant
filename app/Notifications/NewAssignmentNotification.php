<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class NewAssignmentNotification extends Notification
{
    use Queueable, SerializesModels;

    protected $assignment;
    protected $student;

    public function __construct($assignment, $student)
    {
        $this->assignment = $assignment;
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'assignment_id' => $this->assignment->id,
            'assignment_title' => $this->assignment->assignment_title,
            'due_date' => $this->assignment->due_date,
            'student_id' => $this->student->id,
            'student_name' => $this->student->name,
        ];
    }
}
