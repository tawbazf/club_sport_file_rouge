<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    public function view(User $user, Member $member)
    {
        return $user->role === 'admin' || $user->id === $member->user_id;
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Member $member)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Member $member)
    {
        return $user->role === 'admin';
    }
}