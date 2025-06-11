<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Coach;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{


    public function index()
    {
        $courses = Course::with('coach.user', 'reservations')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $coaches = Coach::with('user')->get();
        return view('admin.courses.create', compact('coaches'));
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

        // Check for coach scheduling conflicts
        $existingCourse = Course::where('coach_id', $data['coach_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                      ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
            })->exists();

        if ($existingCourse) {
            return redirect()->back()->withErrors(['coach_id' => 'Le coach est déjà occupé à ce créneau.']);
        }

        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'Cours créé avec succès.');
    }

    public function show(Course $course)
    {
        $course->load('coach.user', 'reservations.member.user');
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $coaches = Coach::with('user')->get();
        return view('admin.courses.edit', compact('course', 'coaches'));
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

        // Check for coach scheduling conflicts (excluding current course)
        $existingCourse = Course::where('coach_id', $data['coach_id'])
            ->where('id', '!=', $course->id)
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                      ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
            })->exists();

        if ($existingCourse) {
            return redirect()->back()->withErrors(['coach_id' => 'Le coach est déjà occupé à ce créneau.']);
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'Cours mis à jour avec succès.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Cours supprimé avec succès.');
    }

    public function checkAndCancel(Course $course)
    {
        $reservations = $course->reservations()->count();
        if ($reservations < 3 && $course->status === 'planned') {
            $course->update(['status' => 'cancelled']);
            return redirect()->route('admin.courses.index')->with('success', 'Cours annulé (moins de 3 participants).');
        }
        return redirect()->route('admin.courses.index')->with('info', 'Aucune annulation nécessaire.');
    }
}