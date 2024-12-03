<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\Course;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        $grade = $student->Grade;
        $major = $student->major_id;
        $level = $student->academic_level_id;
        $courses = Course::where('Grade', $grade)
            ->where('major_id', $major)
            ->where("academic_level_id", $level)
            ->get();

        $student->courses()->attach($courses->pluck('id')->toArray());
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
