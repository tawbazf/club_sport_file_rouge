<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('member.user', 'course', 'session')
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('action_date', [$request->start_date, $request->end_date]);
            })->get();
        return response()->json($logs);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'nullable|exists:members,id',
            'course_id' => 'nullable|exists:courses,id',
            'session_id' => 'nullable|exists:sessions,id',
            'action' => 'required|string|max:255',
            'action_date' => 'required|date',
            'details' => 'nullable|string',
        ]);

        $log = ActivityLog::create($data);
        return response()->json(['message' => 'Activité enregistrée', 'log' => $log], 201);
    }

    public function show(ActivityLog $activityLog)
    {
        $activityLog->load('member.user', 'course', 'session');
        return response()->json($activityLog);
    }
}