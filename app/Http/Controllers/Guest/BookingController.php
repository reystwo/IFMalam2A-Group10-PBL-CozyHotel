<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = \App\Models\Booking::where('user_id', auth()->id())->get();
        return view('guest.bookings.index', compact('bookings'));
    }
}
