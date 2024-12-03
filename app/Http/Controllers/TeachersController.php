<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TeachersController extends Controller
{
    public function create(Request $req)
    {

        $nationality = Country::where('Name', $req->all('nationality'))->first();
        $major = Major::where('Name', $req->all('major'))->first();

        $teacher_id = '2024' . (string)$major->Prefix;
        $teacher_id = (int)str_pad($teacher_id, 12, '0') + 1;
        $tch = Teacher::where([
            ['major_id', $major->id]
        ])->latest()->first();

        if ($tch) {
            $teacher_id = $tch->Student_id + 1;
        }

        $fileName = 'tch_profile_' . $teacher_id . '.' . $req->picture->extension();
        $filePath = '/uploads/teachers/profiles/' . $fileName;
        $req->picture->storeAs('public' . $filePath);

        $teacher = new Teacher();
        $teacher->Teacher_id = $teacher_id;
        $teacher->First_name = $req->first_name;
        $teacher->Last_name = $req->last_name;
        $teacher->Email = $req->email;
        $teacher->Birthday = $req->birthday;
        $teacher->Gender = $req->gender;
        $teacher->country_id = $nationality->id;
        $teacher->major_id = $major->id;
        $teacher->Picture = $filePath;
        $teacher->save();

        return response()->json([
            'teacher' => $teacher
        ]);
    }

    public function get()
    {
        $teachers = Teacher::with(['major', 'country', 'courses' => function ($query) {
            $query->with(['major', 'academic_level', 'students']);
        }])->get();
        return response()->json([
            'teachers' => $teachers
        ]);
    }

    public function login(Request $req)
    {
        if (Auth::guard('teacher')->attempt(['Email' => $req->email, 'password' => $req->password])) {
            /** @var \App\Models\Teacher $teacher */
            $teacher = Auth::guard('teacher')->user();

            $token = $teacher->createToken('TeacherToken')->plainTextToken;
            return response()->json([
                'teacher' => $teacher,
                'role' => $teacher->role,
                'token' => $token,
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function getData(Request $req)
    {
        /** @var \App\Models\Teacher $teacher */
        $teacher = Auth::user();

        if (!$teacher) {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'info' => $teacher,
            'success' => true,
        ]);
    }

    public function logout(Request $req)
    {
        /** @var \App\Models\Teacher $user */
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return response([
            'success' => true,
        ]);
    }

    public function getClasses(Request $req)
    {
        /** @var \App\Models\Teacher $user */
        $user = Auth::user();
        $classes = $user->courses()->with(['major', 'academic_level'])->withCount('students')->get();
        return response()->json($classes);
    }
}
