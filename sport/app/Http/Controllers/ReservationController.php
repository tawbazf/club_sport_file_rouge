<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Course;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('member.user', 'course')->get();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'course_id' => 'required|exists:courses,id',
            'reservation_date' => 'required|date',
            'status' => 'required|in:confirmed,cancelled',
        ]);

        $course = Course::find($data['course_id']);
        if ($course->reservations()->count() >= $course->capacity) {
            return response()->json(['message' => 'Capacité maximale atteinte'], 422);
        }

        $reservation = Reservation::create($data);
        return response()->json(['message' => 'Réservation créée', 'reservation' => $reservation], 201);
    }

    public function show(Reservation $reservation)
    {
        $reservation->load('member.user', 'course', 'attendance');
        return response()->json($reservation);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'status' => 'required|in:confirmed,cancelled',
        ]);

        $reservation->update($data);
        return response()->json(['message' => 'Réservation mise à jour', 'reservation' => $reservation]);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(['message' => 'Réservation supprimée']);
    }
}