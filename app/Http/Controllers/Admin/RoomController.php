<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource with search and filter.
     */
    public function index(Request $request)
    {
        $query = Room::with('roomType');

        // Search by room number
        if ($request->filled('search')) {
            $query->where('room_number', 'like', '%' . $request->search . '%');
        }

        // Filter by room type
        if ($request->filled('room_type_id') && $request->room_type_id !== 'all') {
            $query->where('room_type_id', $request->room_type_id);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $totalRooms = Room::count();
        $rooms = $query->orderBy('room_number', 'asc')->paginate(10)->withQueryString();
        $roomTypes = RoomType::all();

        return view('pages.rooms', compact('rooms', 'roomTypes', 'totalRooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number'  => 'required|string|max:255|unique:rooms,room_number',
            'room_type_id' => 'required|exists:room_types,id',
            'status'       => 'required|in:available,occupied,maintenance,cleaning',
        ], [
            'room_number.required'  => 'Nomor kamar wajib diisi.',
            'room_number.unique'    => 'Nomor kamar sudah digunakan.',
            'room_type_id.required' => 'Tipe kamar wajib dipilih.',
            'room_type_id.exists'   => 'Tipe kamar tidak valid.',
            'status.required'       => 'Status wajib dipilih.',
            'status.in'             => 'Status tidak valid.',
        ]);

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number'  => 'required|string|max:255|unique:rooms,room_number,' . $room->id,
            'room_type_id' => 'required|exists:room_types,id',
            'status'       => 'required|in:available,occupied,maintenance,cleaning',
        ], [
            'room_number.required'  => 'Nomor kamar wajib diisi.',
            'room_number.unique'    => 'Nomor kamar sudah digunakan.',
            'room_type_id.required' => 'Tipe kamar wajib dipilih.',
            'room_type_id.exists'   => 'Tipe kamar tidak valid.',
            'status.required'       => 'Status wajib dipilih.',
            'status.in'             => 'Status tidak valid.',
        ]);

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Kamar #' . $room->room_number . ' berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $roomNumber = $room->room_number;
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Kamar #' . $roomNumber . ' berhasil dihapus!');
    }
}
