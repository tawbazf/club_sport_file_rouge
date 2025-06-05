<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'coach_id',
        'start_time',
        'end_time',
        'capacity',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relations
    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}