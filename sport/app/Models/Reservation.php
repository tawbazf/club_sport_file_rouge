<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'member_id',
        'course_id',
        'reservation_date',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
        'reservation_date' => 'datetime',
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

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }
}