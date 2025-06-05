<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MemberController
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Member::class);
        $members = Member::with('user')->get();
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        $this->authorize('create', Member::class);
        $users = User::where('role', 'member')->whereDoesntHave('member')->get();
        return view('admin.members.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Member::class);
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'status' => 'required|in:active,suspended',
        ]);

        $member = Member::create($data);
        return redirect()->route('members.index')->with('success', 'Membre créé avec succès');
    }

    public function show(Member $member)
    {
        $this->authorize('view', $member);
        $member->load('user', 'subscriptions', 'reservations');
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $this->authorize('update', $member);
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $this->authorize('update', $member);
        $data = $request->validate([
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'status' => 'required|in:active,suspended',
        ]);

        $member->update($data);
        return redirect()->route('members.index')->with('success', 'Membre mis à jour avec succès');
    }

    public function destroy(Member $member)
    {
        $this->authorize('delete', $member);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Membre supprimé avec succès');
    }
}