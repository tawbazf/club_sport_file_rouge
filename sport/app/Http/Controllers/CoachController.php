<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::with('user')->get();
        return response()->json($coaches);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $coach = Coach::create($data);
        return response()->json(['message' => 'Coach créé', 'coach' => $coach], 201);
    }

    public function show(Coach $coach)
    {
        $coach->load('user', 'courses', 'sessions');
        return response()->json($coach);
    }

    public function update(Request $request, Coach $coach)
    {
        $data = $request->validate([
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $coach->update($data);
        return response()->json(['message' => 'Coach mis à jour', 'coach' => $coach]);
    }

    public function destroy(Coach $coach)
    {
        $coach->delete();
        return response()->json(['message' => 'Coach supprimé']);
    }
}