<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Major;
use App\Models\AcademicLevel;
use App\Models\Teacher;

class CoursesController extends Controller
{
    function create(Request $req)
    {
        $major = Major::where('Name', $req->all('major'))->first();
        $level = AcademicLevel::where('Name', $req->all('ac_level'))->first();
        $teacher = Teacher::where('Teacher_id', $req->all('teacher'))->first();
        $course = new Course();
        $course->Name = $req->name;
        $course->Grade = $req->grade;
        $course->C_id = mt_rand(100000, 999999);
        $course->major_id = $major->id;
        $course->academic_level_id = $level->id;
        $course->teacher_id = $teacher->id;

        $course->save();

        return response()->json([
            'success' => true
        ]);
    }

    function get()
    {
        $courses = Course::with(['major', 'academic_level', 'teacher'])->get();

        return response()->json([
            'classes' => $courses
        ]);
    }

    // public function getClassInfo(Request $req, $id)
    // {

    //     /** @var \App\Models\Teacher $teacher */
    //     $teacher = Auth::user();

    //     $class = Course::where('C_id', $id)
    //         ->where('teacher_id', $teacher->id)->with(['major', 'academic_level', 'teacher', 'students' => function ($query) {
    //             $query->with(['major', 'academic_level', 'country', 'courses']);
    //         }])->first();
    //     return response()->json($class);
    // }

    public function getClassInfo(Request $req, $id)
    {
        /** @var \App\Models\Teacher $teacher */
        $teacher = Auth::user();

        $class = Course::where('C_id', $id)
            ->where('teacher_id', $teacher->id)
            ->with([
                'major',
                'academic_level',
                'teacher',
                'students' => function ($query) {
                    $query->with([
                        'major',
                        'academic_level',
                        'country',
                        'courses',
                        'attendances' => function ($attendanceQuery) {
                            $attendanceQuery->select('class_id', 'student_id', 'status');
                        },
                    ]);
                }
            ])
            ->first();

        // Aggregate attendance counts for each student
        if ($class && $class->students) {
            $class->students->each(function ($student) {
                $statuses = ['present', 'absent', 'late', 'excused'];
                $attendanceCounts = array_fill_keys($statuses, 0);

                foreach ($student->attendances as $attendance) {
                    $status = $attendance->status;
                    if (array_key_exists($status, $attendanceCounts)) {
                        $attendanceCounts[$status]++;
                    }
                }

                // Attach attendance counts to the student object
                $student->attendance_summary = $attendanceCounts;

                // Remove the raw attendances data if not needed
                unset($student->attendances);
            });
        }

        return response()->json($class);
    }
}
