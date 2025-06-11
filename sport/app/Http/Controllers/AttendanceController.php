<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::with('member.user', 'course', 'session')
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('attendance_date', [$request->start_date, $request->end_date]);
            })->get();
        return view('admin.reports', compact('attendances'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'course_id' => 'nullable|exists:courses,id',
            'session_id' => 'nullable|exists:sessions,id',
            'status' => 'required|in:present,absent,late',
            'attendance_date' => 'required|date',
        ]);

        $attendance = Attendance::create($data);
        return response()->json(['message' => 'Présence enregistrée', 'attendance' => $attendance], 201);
    }

    public function show(Attendance $attendance)
    {
        $attendance->load('member.user', 'course', 'session');
        return response()->json($attendance);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'status' => 'required|in:present,absent,late',
            'attendance_date' => 'required|date',
        ]);

        $attendance->update($data);
        return response()->json(['message' => 'Présence mise à jour', 'attendance' => $attendance]);
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return response()->json(['message' => 'Présence supprimée']);
    }
}