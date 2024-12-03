<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\Student;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        $grade = $course->Grade;
        $major = $course->major_id;
        $level = $course->academic_level_id;
        $students = Student::where('Grade', $grade)
            ->where('major_id', $major)
            ->where("academic_level_id", $level)
            ->get();

        $course->students()->attach($students->pluck('id')->toArray());
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        //
    }
}
