<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBooking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

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
     * Get status badge color.
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
            'confirmed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
            'checked_in' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
            'completed' => 'bg-slate-50 text-slate-600 border-slate-200',
            'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
            default => 'bg-slate-50 text-slate-600 border-slate-200',
        };
    }

    /**
     * Get status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'checked_in' => 'Checked In',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => 'Unknown',
        };
    }
}
