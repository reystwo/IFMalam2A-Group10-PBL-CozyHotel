<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class AllRoomController extends Controller
{
    /**
     * Menampilkan semua list kamar yang berstatus 'available'
     * khusus untuk halaman resources/views/guest/rooms/index.blade.php
     */
    public function index(Request $request)
    {
        // Mengambil SEMUA data kamar yang berstatus available dari database
        $allAvailableRoomsQuery = Room::with('roomType')->where('status', 'available');

        // Opsional: Filter berdasarkan tipe kamar jika form pencarian digunakan
        if ($request->filled('room_type_id') && $request->room_type_id !== 'all') {
            $allAvailableRoomsQuery->where('room_type_id', $request->room_type_id);
        }

        $rooms = $allAvailableRoomsQuery->get()->map(function ($room) {
            return $this->formatRoomData($room);
        });

        // Mengirimkan data variabel $rooms ke view index milik guest
        return view('guest.rooms.index', compact('rooms'));
    }

    /**
     * Helper untuk menerjemahkan data Model Room ke bentuk Array agar sesuai dengan komponen guest-room-card
     */
    private function formatRoomData($room)
    {
        $typeName = $room->roomType->name ?? 'Standard';

        $images = [
            'Standard' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80',
            'Deluxe'   => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80',
            'Suite'    => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=800&q=80',
            'Family'   => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=800&q=80',
        ];

        $rawPrice = $room->roomType->price ?? 350000;

        return [
            'id'          => $room->id,
            'name'        => $typeName . ' Room #' . $room->room_number,
            'description' => $room->roomType->description ?? ($typeName . ' yang nyaman dengan pelayanan berstandar internasional.'),
            'image'       => $images[$typeName] ?? $images['Standard'],
            'price'       => 'Rp ' . number_format($rawPrice, 0, ',', '.'),
            'available'   => $room->status === 'available',
            'rating'      => number_format(rand(45, 50) / 10, 1),
            'reviews'     => rand(30, 250),
            'capacity'    => ($room->roomType->capacity ?? 2) . ' Adults',
            'amenities'   => [
                ['label' => 'WiFi', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.5 9.5 0 0113.138 0"></path></svg>', 'short_label' => 'FREE WIFI'],
                ['label' => 'Pool', 'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>', 'short_label' => 'POOL'],
            ]
        ];
    }
}
