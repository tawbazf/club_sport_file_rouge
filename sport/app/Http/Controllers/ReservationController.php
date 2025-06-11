<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
   
    public function index()
    {
        $user = auth()->user();
        if (!$user->member) {
            // Option 1: Redirect with error
            return redirect()->back()->with('error', 'Vous n\'êtes pas un membre.');
            // Option 2: Show empty bookings
            // return view('members.bookings', ['reservations' => collect()]);
        }
        $reservations = $user->member->reservations()->with('course')->get();
        return view('members.bookings', compact('reservations'));
    }
    public function classes()
    {
        $courses = Course::with('coach.user', 'reservations')
            ->where('status', 'planned')
            ->where('start_time', '>=', now())
            ->get()
            ->filter(function ($course) {
                return $course->reservations->count() < $course->capacity;
            });

        return view('members.classes', compact('courses'));
    }

    public function bookings()
    {
        $reservations = Reservation::with('course.coach.user')
            ->where('member_id', Auth::user()->member->id)
            ->get();

        return view('members.bookings', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $course = Course::findOrFail($request->course_id);

        if ($course->status !== 'planned') {
            return redirect()->back()->withErrors(['course_id' => 'Ce cours n\'est pas disponible pour réservation.']);
        }

        if ($course->start_time < now()) {
            return redirect()->back()->withErrors(['course_id' => 'Ce cours a déjà commencé.']);
        }

        if ($course->reservations->count() >= $course->capacity) {
            return redirect()->back()->withErrors(['course_id' => 'Ce cours est complet.']);
        }

        $member = Auth::user()->member;
        if (!$member) {
            return redirect()->back()->withErrors(['course_id' => 'Vous n\'êtes pas un membre valide.']);
        }

        if ($course->reservations()->where('member_id', $member->id)->exists()) {
            return redirect()->back()->withErrors(['course_id' => 'Vous avez déjà réservé ce cours.']);
        }

        Reservation::create([
            'member_id' => $member->id,
            'course_id' => $course->id,
            'status' => 'confirmed',
        ]);

        return redirect()->route('member.bookings')->with('success', 'Réservation effectuée avec succès.');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->member_id !== Auth::user()->member->id) {
            abort(403, 'Unauthorized action.');
        }

        $reservation->delete();

        return redirect()->route('member.bookings')->with('success', 'Réservation annulée avec succès.');
    }
}