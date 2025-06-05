<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'member_id',
        'subscription_id',
        'session_id',
        'amount',
        'details',
        'issue_date',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
        'issue_date' => 'datetime',
    ];

    // Relations
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}