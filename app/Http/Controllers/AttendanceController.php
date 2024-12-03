<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function get($class_id)
    {
        $attendance = Attendance::where('class_id', $class_id)->with('student')->orderBy('status')->get();

        return response()->json([
            'attendance' => $attendance
        ]);
    }

    public function changeStatus(Request $req)
    {
        try {
            $att = Attendance::findOrFail($req->att_id);
            $att->status = $req->status;
            $att->save();

            return response()->json([
                'status' => $req->status,
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getAttendanceCounts($studentId)
    {
        $attendanceCounts = DB::table('attendances')
            ->select('status', DB::raw('count(*) as count'))
            ->where('student_id', $studentId)
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statuses = ['present', 'absent', 'late', 'excused'];
        $result = [];

        foreach ($statuses as $status) {
            $result[$status] = $attendanceCounts[$status] ?? 0;
        }

        return $result;
    }
}
