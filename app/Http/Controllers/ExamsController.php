<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    public function create(Request $request)
{
    $teacher = Auth::user();
    
    $course = Course::where([
        'C_id' => $request->course_id,
        'teacher_id' => $teacher->id
    ])->with('students')->first();

    if (!$course) {
        return response()->json([
            'message' => 'Course not found with given course_id or unauthorized.',
        ], 404);
    }

    $exam = Exam::create([
        'name' => $request->label,
        'exam_date' => $request->exam_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'course_id' => $course->id,
    ]);

    $response = [
        'id' => $exam->id,
        'name' => $exam->name,
        'exam_date' => $exam->exam_date,
        'start_time' => $exam->start_time,
        'end_time' => $exam->end_time,
        'students' => $course->students->map(function ($student) {
            return [
                'info' => $student,
                'mark' => null,
                'mark_id' => null,
            ];
        }),
    ];

    return response()->json([
        'exams' => [$response]
    ], 201);
}


        public function get($course_id)
{
    /** @var \App\Models\Teacher $teacher */
    $teacher = Auth::user();

    $course = Course::where(['C_id' => $course_id, 'teacher_id' => $teacher->id])
        ->with(['exams.marks', 'exams.marks.student', 'students'])
        ->first();

    if (!$course) {
        return response()->json(['error' => 'Course not found or unauthorized'], 403);
    }
    $exams = $course->exams->map(function ($exam) use ($course) {
        return [
            'id' => $exam->id,
            'name' => $exam->name,
            'exam_date' => $exam->exam_date,
            'start_time' => $exam->start_time,
            'end_time' => $exam->end_time,
            'students' => $course->students->map(function ($student) use ($exam) {
                $grade = $exam->marks->firstWhere('student_id', $student->id);

                return [
                    'info' => $student,
                    'mark' => $grade ? $grade->grade : null,
                    'mark_id' => $grade ? $grade->id : null,
                ];
            }),
        ];
    });

    return response()->json([
        'exams' => $exams
    ]);
}

public function setMark(Request $request)
{
    $validated = $request->validate([
        'exam_id' => 'required|exists:exams,id',
        'student' => 'required|exists:students,id',
        'new_grade' => 'required|numeric|min:0|max:100',
        'mark_id' => 'nullable|exists:marks,id', 
    ]);

    if ($validated['mark_id']) {
        $mark = Mark::find($validated['mark_id']);
        $mark->grade = $validated['new_grade'];
        $mark->save();
    } else {
        $mark = Mark::create([
            'exam_id' => $validated['exam_id'],
            'student_id' => $validated['student'],
            'grade' => $validated['new_grade'],
        ]);
    }

    return response()->json([
        'message' => 'Mark saved successfully.',
        'mark' => $mark
    ]);
}
}
