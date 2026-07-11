<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // 'floor' dihapus dari mass assignment
    protected $fillable = [
        'room_type_id',
        'room_number',
        'status'
    ];

    /**
     * Get the room type that this room belongs to.
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Get the bookings for this room.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
