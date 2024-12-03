<?php

namespace App\Http\Controllers;

use App\Models\AcademicLevel;
use App\Models\Country;
use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function create(Request $req)
    {


        $nationality = Country::where('Name', $req->all('nationality'))->first();
        $major = Major::where('Name', $req->all('major'))->first();
        $level = AcademicLevel::where('Name', $req->all('ac_level'))->first();


        $student_id = (string)$req->grade . (string)$major->Prefix;
        $student_id = (int)str_pad($student_id, 12, '0') + 1;

        $std = Student::where([
            ['Grade', $req->grade],
            ['major_id', $major->id]
        ])->latest()->first();

        if ($std) {
            $student_id = $std->Student_id + 1;
        }

        $fileName = 'std_profile_' . $student_id . '.' . $req->picture->extension();
        $filePath = '/uploads/students/profiles/' . $fileName;
        $req->picture->storeAs('public' . $filePath);

        $student = new Student();
        $student->Student_id = $student_id;
        $student->First_name = $req->first_name;
        $student->Last_name = $req->last_name;
        $student->Email = $req->email;
        $student->Birthday = $req->birthday;
        $student->Gender = $req->gender;
        $student->country_id = $nationality->id;
        $student->Grade = $req->grade;
        $student->major_id = $major->id;
        $student->academic_level_id = $level->id;
        $student->Picture = $filePath;

        $student->save();

        return response()->json([
            'student' => $student
        ]);
    }

    function get()
    {
        $students = Student::with(['major', 'country', 'academic_level', 'courses' => function ($query) {
            $query->with(['major', 'academic_level', 'teacher']);
        }])->get();

        return response()->json([
            'students' => $students
        ]);
    }
}
