<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'policy_no',
        'broker',
        'insurer',
        'premium',
        'last_paid',
        'arrears_amount',
        'payments_missed',
        'meeting_date',
        'follow_up_date',
        'status',
        'client_inactive',
        'notes',
    ];

    // Relationship with Client model
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
