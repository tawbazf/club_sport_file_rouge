<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'member_id',
        'type',
        'start_date',
        'end_date',
        'price',
        'status',
    ];

    protected $casts = [
        'type' => 'string',
        'status' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relations
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}