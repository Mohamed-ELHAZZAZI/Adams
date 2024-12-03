<?php

namespace App\Observers;

use App\Models\ClassSession;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class ClassSessionObserver
{
    /**
     * Handle the ClassSession "created" event.
     *
     * @param  \App\Models\ClassSession  $classSession
     * @return void
     */
    public function created(ClassSession $classSession): void
    {
        $students = $classSession->course->students;

        foreach ($students as $student) {
            Attendance::create([
                'class_id' => $classSession->id,
                'student_id' => $student->id,
            ]);
        }
    }

    /**
     * Handle the ClassSession "updated" event.
     */
    public function updated(ClassSession $classSession): void
    {
        //
    }

    /**
     * Handle the ClassSession "deleted" event.
     */
    public function deleted(ClassSession $classSession): void
    {
        //
    }

    /**
     * Handle the ClassSession "restored" event.
     */
    public function restored(ClassSession $classSession): void
    {
        //
    }

    /**
     * Handle the ClassSession "force deleted" event.
     */
    public function forceDeleted(ClassSession $classSession): void
    {
        //
    }
}
