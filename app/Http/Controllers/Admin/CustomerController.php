<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers with search and filter.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search by name, email, or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $totalCustomers = Customer::count();
        $customers = $query->withCount('bookings')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10)
                           ->withQueryString();

        return view('pages.customers', compact('customers', 'totalCustomers'));
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'id_number' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'Nama customer wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $customer = Customer::create($validated);

        ActivityLog::log('create', 'Customer', $customer->name, 'Customer baru "' . $customer->name . '" (' . $customer->email . ') ditambahkan.');

        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'id_number' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'Nama customer wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $customer->update($validated);

        ActivityLog::log('update', 'Customer', $customer->name, 'Data customer "' . $customer->name . '" diperbarui.');

        return redirect()->route('customers.index')->with('success', 'Customer "' . $customer->name . '" berhasil diperbarui!');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        $customerName = $customer->name;

        // Check if customer has active bookings
        $activeBookings = $customer->bookings()->whereIn('status', ['pending', 'confirmed', 'checked_in'])->count();
        if ($activeBookings > 0) {
            return redirect()->route('customers.index')->with('error', 'Customer "' . $customerName . '" tidak dapat dihapus karena memiliki ' . $activeBookings . ' booking aktif.');
        }

        ActivityLog::log('delete', 'Customer', $customerName, 'Customer "' . $customerName . '" dihapus.');

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer "' . $customerName . '" berhasil dihapus!');
    }
}
