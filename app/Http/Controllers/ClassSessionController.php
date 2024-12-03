<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSessionController extends Controller
{
    public function create(Request $req)
    {
        try {
            $course_id = Course::where('C_id', $req->course_id)->first()->id;

            $C_Session = new ClassSession();
            $C_Session->course_id = $course_id;
            $C_Session->title = $req->label;
            $C_Session->class_date = $req->class_date;
            $C_Session->start_time = $req->start_time;
            $C_Session->end_time = $req->end_time;

            $C_Session->save();

            return response()->json([
                'success' => true,
                'classSession' => $C_Session
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function get($course_id)
    {
        /** @var \App\Models\Teacher $teacher */
        $teacher = Auth::user();

        $course = Course::where(['C_id' => $course_id, 'teacher_id' => $teacher->id])
            ->with('classes')
            ->first();


        if (!$course) {
            return response()->json(['error' => 'Course not found or unauthorized'], 403);
        }

        return response()->json($course->classes);
    }
}
