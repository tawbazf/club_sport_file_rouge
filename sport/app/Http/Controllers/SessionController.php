<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::whereHas('course', function ($query) {
            $query->where('coach_id', Auth::user()->id);
        })->get();

        return view('coach.sessions', compact('sessions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'coach_id' => 'required|exists:coaches,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:1',
            'status' => 'required|in:planned,completed,cancelled',
        ]);

        // Vérifier que le coach n'a pas d'autre séance ou cours à ce moment
        $existingSession = Session::where('coach_id', $data['coach_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                      ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
            })->exists();

        $existingCourse = Course::where('coach_id', $data['coach_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                      ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
            })->exists();

        if ($existingSession || $existingCourse) {
            return response()->json(['message' => 'Le coach est déjà occupé à ce créneau'], 422);
        }

        $session = Session::create($data);
        return response()->json(['message' => 'Séance créée', 'session' => $session], 201);
    }

    public function show(Session $session)
    {
        $session->load('member.user', 'coach.user', 'attendance');
        return response()->json($session);
    }

    public function update(Request $request, Session $session)
    {
        $data = $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:1',
            'status' => 'required|in:planned,completed,cancelled',
        ]);

        $session->update($data);
        return response()->json(['message' => 'Séance mise à jour', 'session' => $session]);
    }

    public function destroy(Session $session)
    {
        $session->delete();
        return response()->json(['message' => 'Séance supprimée']);
    }
}