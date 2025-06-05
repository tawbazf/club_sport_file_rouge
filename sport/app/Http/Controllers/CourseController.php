<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('coach.user', 'reservations')->get();
        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coach_id' => 'required|exists:coaches,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:planned,cancelled,completed',
        ]);

        // Vérifier qu'aucun cours n'est planifié pour le coach à ce moment
        $existingCourse = Course::where('coach_id', $data['coach_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                      ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
            })->exists();

        if ($existingCourse) {
            return response()->json(['message' => 'Le coach est déjà occupé à ce créneau'], 422);
        }

        $course = Course::create($data);
        return response()->json(['message' => 'Cours créé', 'course' => $course], 201);
    }

    public function show(Course $course)
    {
        $course->load('coach.user', 'reservations.member.user');
        return response()->json($course);
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coach_id' => 'required|exists:coaches,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:planned,cancelled,completed',
        ]);

        $course->update($data);
        return response()->json(['message' => 'Cours mis à jour', 'course' => $course]);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Cours supprimé']);
    }

    public function checkAndCancel(Course $course)
    {
        $reservations = $course->reservations()->count();
        if ($reservations < 3 && $course->status === 'planned') {
            $course->update(['status' => 'cancelled']);
            return response()->json(['message' => 'Cours annulé (moins de 3 participants)']);
        }
        return response()->json(['message' => 'Aucune annulation nécessaire']);
    }
}