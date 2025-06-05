<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'member_id',
        'course_id',
        'session_id',
        'status',
        'attendance_date',
    ];

    protected $casts = [
        'status' => 'string',
        'attendance_date' => 'datetime',
    ];

    // Relations
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}