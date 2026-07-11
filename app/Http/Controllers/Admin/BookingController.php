<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings with search and filter.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'room', 'roomType']);

        // Search by guest name, email or booking ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('guest_name', 'like', "%{$search}%")
                  ->orWhere('guest_email', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%")
                  ->orWhereHas('customer', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by room type
        if ($request->filled('room_type_id') && $request->room_type_id !== 'all') {
            $query->where('room_type_id', $request->room_type_id);
        }

        $totalBookings = Booking::count();
        $bookings = $query->orderBy('created_at', 'desc')
                          ->paginate(10)
                          ->withQueryString();

        $roomTypes = RoomType::all();

        // Status counts for summary cards
        $statusCounts = [
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'checked_in' => Booking::where('status', 'checked_in')->count(),
            'checked_out' => Booking::where('status', 'checked_out')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];

        return view('pages.bookings.index', compact('bookings', 'totalBookings', 'roomTypes', 'statusCounts'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $customers = Customer::where('status', 'active')->orderBy('name')->get();
        $roomTypes = RoomType::all();
        $availableRooms = Room::with('roomType')
                              ->where('status', 'available')
                              ->orderBy('room_number')
                              ->get();

        return view('pages.bookings.create', compact('customers', 'roomTypes', 'availableRooms'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'status' => 'nullable|in:pending,confirmed,cancelled,checked_in,checked_out',
        ], [
            'guest_name.required' => 'Nama tamu wajib diisi.',
            'guest_email.required' => 'Email tamu wajib diisi.',
            'guest_email.email' => 'Format email tidak valid.',
            'room_id.required' => 'Kamar wajib dipilih.',
            'room_id.exists' => 'Kamar tidak valid.',
            'check_in.required' => 'Tanggal check-in wajib diisi.',
            'check_in.after_or_equal' => 'Tanggal check-in tidak boleh di masa lalu.',
            'check_out.required' => 'Tanggal check-out wajib diisi.',
            'check_out.after' => 'Tanggal check-out harus setelah tanggal check-in.',
        ]);

        // Get room and calculate price
        $room = Room::with('roomType')->findOrFail($validated['room_id']);
        $checkIn = \Carbon\Carbon::parse($validated['check_in']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->roomType->price * $nights;

        // If customer_id is not provided but we have a new customer, create one
        $customerId = $validated['customer_id'] ?? null;

        // Create booking
        $booking = Booking::create([
            'customer_id' => $customerId,
            'room_type_id' => $room->room_type_id,
            'room_id' => $room->id,
            'guest_name' => $validated['guest_name'],
            'guest_email' => $validated['guest_email'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'room_count' => 1,
            'total_price' => $totalPrice,
            'status' => $validated['status'] ?? 'confirmed',
        ]);

        // Update room status to occupied
        $room->update(['status' => 'occupied']);

        ActivityLog::log('create', 'Booking', 'Booking #' . $booking->id, 'Booking baru dibuat untuk ' . $booking->guest_name . ' di Room #' . $room->room_number . ' (' . $validated['check_in'] . ' s/d ' . $validated['check_out'] . '). Total: Rp ' . number_format($totalPrice, 0, ',', '.'));

        return redirect()->route('bookings.index')->with('success', 'Booking #' . $booking->id . ' berhasil dibuat untuk ' . $booking->guest_name . '!');
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'guest_name' => 'sometimes|required|string|max:255',
            'guest_email' => 'sometimes|required|email|max:255',
            'room_id' => 'sometimes|required|exists:rooms,id',
            'check_in' => 'sometimes|required|date',
            'check_out' => 'sometimes|required|date|after:check_in',
            'status' => 'sometimes|required|in:pending,confirmed,cancelled,checked_in,checked_out',
        ]);

        // If status is changing to checked_out or cancelled, free the room
        if (isset($validated['status'])) {
            $oldStatus = $booking->status;
            $newStatus = $validated['status'];

            if (in_array($newStatus, ['checked_out', 'cancelled']) && !in_array($oldStatus, ['checked_out', 'cancelled'])) {
                if ($booking->room) {
                    $booking->room->update(['status' => $newStatus === 'checked_out' ? 'cleaning' : 'available']);
                }
            }

            // If status is changing to confirmed or checked_in, mark room as occupied
            if (in_array($newStatus, ['confirmed', 'checked_in']) && in_array($oldStatus, ['pending'])) {
                if ($booking->room) {
                    $booking->room->update(['status' => 'occupied']);
                }
            }
        }

        // Recalculate price if room or dates changed
        if (isset($validated['room_id']) || isset($validated['check_in']) || isset($validated['check_out'])) {
            $roomId = $validated['room_id'] ?? $booking->room_id;
            $checkIn = \Carbon\Carbon::parse($validated['check_in'] ?? $booking->check_in);
            $checkOut = \Carbon\Carbon::parse($validated['check_out'] ?? $booking->check_out);
            $room = Room::with('roomType')->findOrFail($roomId);
            $nights = $checkIn->diffInDays($checkOut);
            $validated['total_price'] = $room->roomType->price * $nights;
            $validated['room_type_id'] = $room->room_type_id;
        }

        $booking->update($validated);

        ActivityLog::log('update', 'Booking', 'Booking #' . $booking->id, 'Booking #' . $booking->id . ' (' . $booking->guest_name . ') diperbarui.' . (isset($validated['status']) ? ' Status: ' . $oldStatus . ' → ' . $newStatus . '.' : ''));

        return redirect()->route('bookings.index')->with('success', 'Booking #' . $booking->id . ' berhasil diperbarui!');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        $bookingId = $booking->id;

        // Free the room if booking was active
        if ($booking->room && in_array($booking->status, ['pending', 'confirmed', 'checked_in'])) {
            $booking->room->update(['status' => 'available']);
        }

        ActivityLog::log('delete', 'Booking', 'Booking #' . $bookingId, 'Booking #' . $bookingId . ' (' . $booking->guest_name . ') dihapus.');

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking #' . $bookingId . ' berhasil dihapus!');
    }
}
