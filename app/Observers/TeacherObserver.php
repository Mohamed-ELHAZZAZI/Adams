<?php

namespace App\Observers;

use App\Models\Teacher;
use App\Mail\TeacherPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendTeacherPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TeacherObserver
{
    /**
     * Handle the Teacher "created" event.
     */
    public function created(Teacher $teacher): void
    {

        $temporaryPassword = Str::random(10);

        // Hash the password and update the teacher's record
        $teacher->password = Hash::make($temporaryPassword);
        $teacher->saveQuietly(); // Save without triggering events
        // Dispatch the job to send the email
        SendTeacherPasswordMail::dispatch($temporaryPassword, $teacher->First_name, $teacher->Email);
    }

    /**
     * Handle the Teacher "updated" event.
     */
    public function updated(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "deleted" event.
     */
    public function deleted(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "restored" event.
     */
    public function restored(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "force deleted" event.
     */
    public function forceDeleted(Teacher $teacher): void
    {
        //
    }
}
