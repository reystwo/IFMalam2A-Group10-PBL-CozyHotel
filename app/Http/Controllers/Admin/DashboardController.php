<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // 1. Total Rooms
        $totalRooms = Room::count();

        // 2. Total Active Guests (Bookings with status 'confirmed' or 'checked_in')
        $activeGuests = Booking::whereIn('status', ['confirmed', 'checked_in'])->count();

        // 3. Total Transactions
        $totalTransactions = Transaction::count();

        // 4. Recent Transactions (last 10)
        $recentTransactions = Transaction::with(['booking', 'customer'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($transaction) {
                $booking = $transaction->booking;
                $room = $booking ? $booking->room : null;
                $roomType = $room ? $room->roomType : null;

                return [
                    'id' => $transaction->id,
                    'customer_name' => $transaction->customer->name ?? ($booking ? $booking->guest_name : 'N/A'),
                    'room_name' => $roomType ? $roomType->name : 'N/A',
                    'room_number' => $room ? $room->room_number : 'N/A',
                    'amount' => $transaction->amount,
                    'amount_formatted' => 'Rp ' . number_format($transaction->amount, 0, ',', '.'),
                    'status' => $transaction->status,
                    // PERBAIKAN 1: Bungkus dengan Carbon::parse untuk mencegah error string
                    'date' => Carbon::parse($transaction->created_at)->format('M d, Y'),
                ];
            });

        // 5. Occupancy Rate Calculation
        $occupancyRate = $totalRooms > 0 ? round(($activeGuests / $totalRooms) * 100, 1) : 0;

        // 6. Today's Transactions Volume
        $todayTransactions = Transaction::whereDate('created_at', Carbon::today())->count();

        // 7. Monthly Revenue (Current Year)
        $monthlyRevenue = Transaction::whereYear('created_at', Carbon::now()->year)->sum('amount');

        // 8. Booking Statistics by Status
        $bookingStats = [
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'checked_in' => Booking::where('status', 'checked_in')->count(),
            'checked_out' => Booking::where('status', 'checked_out')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];

        // 9. Recent Bookings (last 5)
        $recentBookings = Booking::with(['room', 'roomType'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($booking) {
                $room = $booking->room;
                $roomType = $booking->roomType;

                return [
                    'id' => $booking->id,
                    'guest_name' => $booking->guest_name,
                    'room_name' => $roomType ? $roomType->name : 'N/A',
                    'room_number' => $room ? $room->room_number : 'N/A',
                    // PERBAIKAN 2: Bungkus dengan Carbon::parse untuk mencegah error string
                    'check_in' => Carbon::parse($booking->check_in)->format('M d, Y'),
                    'status' => $booking->status,
                    'status_label' => $booking->status_label ?? ucfirst($booking->status),
                    'status_badge' => $booking->status_badge_color ?? 'bg-slate-50 text-slate-600 border-slate-200',
                    'total_price' => $booking->total_price,
                    'total_price_formatted' => 'Rp ' . number_format($booking->total_price, 0, ',', '.'),
                ];
            });

        // 10. Total Customers
        $totalCustomers = Customer::count();

        return view('pages.dashboard', compact(
            'totalRooms',
            'activeGuests',
            'totalTransactions',
            'recentTransactions',
            'occupancyRate',
            'todayTransactions',
            'monthlyRevenue',
            'bookingStats',
            'recentBookings',
            'totalCustomers'
        ));
    }
}
