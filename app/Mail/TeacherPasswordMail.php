<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $temporaryPassword;
    public $teacherName;

    /**
     * Create a new message instance.
     *
     * @param string $temporaryPassword
     * @param string $teacherName
     */
    public function __construct($temporaryPassword, $teacherName)
    {
        $this->temporaryPassword = $temporaryPassword;
        $this->teacherName = $teacherName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Temporary Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.teacher_password_email',
            with: [
                'temporaryPassword' => $this->temporaryPassword,
                'teacherName' => $this->teacherName,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
