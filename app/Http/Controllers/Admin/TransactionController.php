<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of bookings with their payment info.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'room', 'roomType', 'transactions'])
                        ->whereIn('status', ['confirmed', 'checked_in', 'checked_out', 'pending']);

        // Search by guest name or booking ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('guest_name', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Filter by payment status
        if ($request->filled('payment_status') && $request->payment_status !== 'all') {
            $query->get()->filter(function ($booking) use ($request) {
                return $booking->payment_status === $request->payment_status;
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')
                          ->paginate(10)
                          ->withQueryString();

        // Summary stats
        $allBookings = Booking::with('transactions')->get();
        $totalRevenue = $allBookings->sum('total_price');
        $totalPaid = Transaction::sum('amount');
        $totalBalance = $totalRevenue - $totalPaid;

        return view('pages.transactions', compact('bookings', 'totalRevenue', 'totalPaid', 'totalBalance'));
    }

    /**
     * Store a new payment transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:cash,card,transfer,digital',
            'payment_date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ], [
            'booking_id.required' => 'Booking wajib dipilih.',
            'amount.required' => 'Jumlah pembayaran wajib diisi.',
            'amount.min' => 'Jumlah pembayaran minimal Rp 1.',
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
            'payment_date.required' => 'Tanggal pembayaran wajib diisi.',
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);

        $transaction = Transaction::create($validated);

        // Log activity
        ActivityLog::log(
            'create',
            'Transaction',
            'Payment Rp ' . number_format($validated['amount'], 0, ',', '.'),
            'Pembayaran Rp ' . number_format($validated['amount'], 0, ',', '.') . ' untuk Booking #' . $booking->id . ' (' . $booking->guest_name . ') via ' . $transaction->method_label . '.'
        );

        return redirect()->route('transactions.index')->with('success', 'Pembayaran Rp ' . number_format($validated['amount'], 0, ',', '.') . ' berhasil dicatat untuk Booking #' . $booking->id . '!');
    }
}
