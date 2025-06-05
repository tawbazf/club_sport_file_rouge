<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'birth_date',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
        'birth_date' => 'date',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}