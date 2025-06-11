<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{

    public function index()
    {
        $coaches = Coach::with('user')->get();
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        $users = User::where('role', 'coach')->whereDoesntHave('coach')->get();
        return view('admin.coaches.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Coach::create($data);

        return redirect()->route('admin.coaches.index')->with('success', 'Coach créé avec succès.');
    }

    public function show(Coach $coach)
    {
        $coach->load('user', 'courses', 'sessions');
        return view('admin.coaches.show', compact('coach'));
    }

    public function edit(Coach $coach)
    {
        $users = User::where('role', 'coach')->get();
        return view('admin.coaches.edit', compact('coach', 'users'));
    }

    public function update(Request $request, Coach $coach)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $coach->update($data);

        return redirect()->route('admin.coaches.index')->with('success', 'Coach mis à jour avec succès.');
    }

    public function destroy(Coach $coach)
    {
        $coach->delete();
        return redirect()->route('admin.coaches.index')->with('success', 'Coach supprimé avec succès.');
    }
}