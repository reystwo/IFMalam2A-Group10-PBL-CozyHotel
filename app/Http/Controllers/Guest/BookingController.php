<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\GuestBooking;
use App\Models\Room;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the user's bookings.
     */
    public function index()
    {
        // Ambil semua booking milik user yang sedang login
        $bookings = GuestBooking::with(['room', 'roomType', 'customer'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($booking) {
                return $this->formatBookingData($booking);
            });

        return view('guest.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create($roomId)
    {
        $room = Room::with('roomType')->findOrFail($roomId);
        $formattedRoom = $this->formatRoomData($room);

        return view('guest.bookings.create', compact('formattedRoom'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'payment_method' => 'required|string',
            'requests' => 'nullable|string',
        ]);

        $room = Room::with('roomType')->findOrFail($request->room_id);

        // Calculate nights
        $checkIn = \Carbon\Carbon::parse($request->check_in);
        $checkOut = \Carbon\Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);

        // Get price from database
        $pricePerNight = $room->roomType->price ?? 0;
        $totalPrice = $pricePerNight * $nights;

        // Cari atau buat customer
        $customer = Customer::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'phone' => $request->phone,
            ]
        );

        // Create booking
        $booking = GuestBooking::create([
            'user_id' => Auth::id(),
            'customer_id' => $customer->id,
            'room_type_id' => $room->room_type_id,
            'room_id' => $request->room_id,
            'guest_name' => $request->name,
            'guest_email' => $request->email,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'room_count' => 1,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Update room status to occupied
        $room->update(['status' => 'occupied']);

        return redirect()
            ->route('guest.bookings.index')
            ->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        $booking = GuestBooking::with(['room', 'roomType', 'customer'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $formattedBooking = $this->formatBookingData($booking);

        return view('guest.bookings.show', compact('formattedBooking'));
    }

    /**
     * Cancel the specified booking.
     */
    public function cancel($id)
    {
        $booking = GuestBooking::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->findOrFail($id);

        $booking->update(['status' => 'cancelled']);

        if ($booking->room) {
            $booking->room->update(['status' => 'available']);
        }

        return redirect()
            ->route('guest.bookings.index')
            ->with('info', 'Booking cancelled successfully.');
    }

    /**
     * Display invoice for the specified booking.
     */
    public function invoice($id)
    {
        $booking = GuestBooking::with(['room', 'roomType', 'customer'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $formattedBooking = $this->formatBookingData($booking);

        return view('guest.bookings.invoice', compact('formattedBooking'));
    }

    /**
     * Format room data for display.
     */
    private function formatRoomData($room)
    {
        $images = [
            'Standard' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'Deluxe'   => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'Suite'    => 'https://images.unsplash.com/photo-1582719478250-c89cae4df85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'Family'   => 'https://images.unsplash.com/photo-1560185007-c5ca9d2c014d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ];

        $typeName = $room->roomType->name ?? 'Standard';
        $rawPrice = $room->roomType->price ?? 0;

        return [
            'id'          => $room->id,
            'room_type_id'=> $room->room_type_id,
            'name'        => $typeName . ' Room #' . $room->room_number,
            'description' => $room->roomType->description ?? ($typeName . ' nyaman dengan fasilitas penunjang terbaik untuk Anda.'),
            'image'       => $images[$typeName] ?? $images['Standard'],
            'price'       => $rawPrice,
            'price_formatted' => 'Rp ' . number_format($rawPrice, 0, ',', '.'),
            'available'   => $room->status === 'available',
            'rating'      => number_format(rand(45, 50) / 10, 1),
            'reviews'     => rand(30, 250),
            'capacity'    => ($room->roomType->capacity ?? 2) . ' Adults',
            'size'        => '32m²',
            'amenities'   => [
                [
                    'label' => 'WiFi',
                    'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>',
                    'short_label' => 'WIFI'
                ],
                [
                    'label' => 'AC',
                    'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"></path></svg>',
                    'short_label' => 'AC'
                ],
                [
                    'label' => 'King Bed',
                    'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18"></path></svg>',
                    'short_label' => 'KING'
                ],
            ]
        ];
    }

    /**
     * Format booking data for display.
     */
    private function formatBookingData($booking)
    {
        $room = $booking->room;
        $roomType = $booking->roomType;
        $typeName = $roomType->name ?? 'Standard';

        $images = [
            'Standard' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'Deluxe'   => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'Suite'    => 'https://images.unsplash.com/photo-1582719478250-c89cae4df85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'Family'   => 'https://images.unsplash.com/photo-1560185007-c5ca9d2c014d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ];

        return [
            'id' => $booking->id,
            'room_id' => $booking->room_id,
            'room_title' => $typeName . ' Room #' . ($room->room_number ?? 'N/A'),
            'room_image' => $images[$typeName] ?? $images['Standard'],
            'status' => $booking->status,
            'status_badge' => $booking->status_badge_color,
            'status_label' => $booking->status_label,
            'check_in' => $booking->check_in->format('M d, Y'),
            'check_out' => $booking->check_out->format('M d, Y'),
            'check_in_raw' => $booking->check_in->format('Y-m-d'),
            'check_out_raw' => $booking->check_out->format('Y-m-d'),
            'nights' => $booking->nights,
            'room_count' => $booking->room_count,
            'total_price' => $booking->total_price,
            'total_price_formatted' => 'Rp ' . number_format($booking->total_price, 0, ',', '.'),
            'guest_name' => $booking->guest_name,
            'guest_email' => $booking->guest_email,
            'created_at' => $booking->created_at->format('M d, Y'),
            'customer' => $booking->customer,
        ];
    }
}
