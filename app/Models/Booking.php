<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'room_type_id',
        'room_id',
        'guest_name',
        'guest_email',
        'check_in',
        'check_out',
        'room_count',
        'total_price',
        'status',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the user that made this booking (if logged in).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customer for this booking.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the room type for this booking.
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Get the specific room assigned to this booking.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Calculate the number of nights.
     */
    public function getNightsAttribute()
    {
        if ($this->check_in && $this->check_out) {
            return $this->check_in->diffInDays($this->check_out);
        }
        return 0;
    }

    /**
     * Get all payment transactions for this booking.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get total amount paid.
     */
    public function getPaidAmountAttribute()
    {
        return $this->transactions()->sum('amount');
    }

    /**
     * Get remaining balance.
     */
    public function getBalanceAttribute()
    {
        return $this->total_price - $this->paid_amount;
    }

    /**
     * Get payment status.
     */
    public function getPaymentStatusAttribute()
    {
        if ($this->paid_amount >= $this->total_price) {
            return 'fully_paid';
        } elseif ($this->paid_amount > 0) {
            return 'dp_paid';
        }
        return 'unpaid';
    }
}
