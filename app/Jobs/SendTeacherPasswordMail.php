<?php

namespace App\Jobs;

use App\Mail\TeacherPasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendTeacherPasswordMail implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public $temporaryPassword;
    public $teacherName;
    public $teacherEmail;

    /**
     * Create a new job instance.
     *
     * @param string $temporaryPassword
     * @param string $teacherName
     * @param string $teacherEmail
     */
    public function __construct($temporaryPassword, $teacherName, $teacherEmail)
    {
        $this->temporaryPassword = $temporaryPassword;
        $this->teacherName = $teacherName;
        $this->teacherEmail = $teacherEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->teacherEmail)->send(new TeacherPasswordMail($this->temporaryPassword, $this->teacherName));
    }
}
