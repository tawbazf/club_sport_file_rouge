<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_login_at',
    ];

    protected $casts = [
        'role' => 'string',
        'last_login_at' => 'datetime',
    ];

    // Relations
    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function coach()
    {
        return $this->hasOne(Coach::class);
    }
}