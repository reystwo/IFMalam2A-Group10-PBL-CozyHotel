<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'payment_date',
        'note',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the booking for this transaction.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the payment method label.
     */
    public function getMethodLabelAttribute()
    {
        return match($this->payment_method) {
            'cash' => 'Cash',
            'card' => 'Credit / Debit Card',
            'transfer' => 'Bank Transfer',
            'digital' => 'Digital Wallet',
            default => $this->payment_method,
        };
    }
}
