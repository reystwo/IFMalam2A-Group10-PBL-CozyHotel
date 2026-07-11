<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'address',
        'id_number',
        'status',
    ];

    /**
     * Get all bookings for this customer.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
