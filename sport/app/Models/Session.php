<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'training_sessions';

    protected $fillable = [
        'member_id',
        'coach_id',
        'start_time',
        'end_time',
        'duration',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relations
    public function course()
{
    return $this->belongsTo(Course::class);
}
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}