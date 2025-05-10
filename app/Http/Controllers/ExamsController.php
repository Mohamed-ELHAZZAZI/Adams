<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    public function create(Request $request) {
        $course = Course::where('C_id', $request->course_id)->first();
     
        if (!$course) {
            return response()->json([
                'message' => 'Course not found with given course_id.',
            ], 404);
        }
        $exam = Exam::create([
            'name' => $request->label,
            'exam_date' =>  $request->exam_date,
            'start_time' =>  $request->start_time,
            'end_time' =>  $request->end_time,
            'course_id' => $course->id, 
        ]);
        return response()->json([
            'message' => 'Exam created successfully.',
            'exam' => $exam,
        ], 201);
    
    }

        public function get($course_id)
    {
        /** @var \App\Models\Teacher $teacher */
        $teacher = Auth::user();

        // Find the course using the custom C_id and teacher_id
        $course = Course::where(['C_id' => $course_id, 'teacher_id' => $teacher->id])
            ->with([
                'exams.marks.student' 
            ])
            ->first();

        if (!$course) {
            return response()->json(['error' => 'Course not found or unauthorized'], 403);
        }

        return response()->json([
            'exams' => $course->exams
        ]);
    }

}
