<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'member_id',
        'course_id',
        'session_id',
        'action',
        'action_date',
        'details',
    ];

    protected $casts = [
        'action_date' => 'datetime',
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