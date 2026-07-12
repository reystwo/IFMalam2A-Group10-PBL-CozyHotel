<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of recommended and available rooms for home page.
     */
    public function index(Request $request)
    {
        // 1. Ambil data Available Rooms (Kamar dengan status available) - hanya 3 secara acak
        $availableRoomsQuery = Room::with('roomType')
            ->where('status', 'available');

        // Filter Pencarian Tipe Kamar jika Form disubmit
        if ($request->filled('room_type_id') && $request->room_type_id !== 'all') {
            $availableRoomsQuery->where('room_type_id', $request->room_type_id);
        }

        // Ambil hanya 3 kamar available secara acak
        $availableRooms = $availableRoomsQuery
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->map(function ($room) {
                return $this->formatRoomData($room);
            });

        // 2. Ambil data Recommended Stays (Rekomendasi kamar berstatus available secara acak)
        $recommendedRooms = Room::with('roomType')
            ->where('status', 'available')
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->map(function ($room) {
                return $this->formatRoomData($room);
            });

        return view('customer.home', compact('availableRooms', 'recommendedRooms'));
    }

    /**
     * Display a listing of all available rooms for rooms list page.
     */
    public function list(Request $request)
    {
        $rooms = Room::with('roomType')
            ->where('status', 'available')
            ->get()
            ->map(function ($room) {
                return $this->formatRoomData($room);
            });

        return view('guest.rooms.index', compact('rooms'));
    }

    /**
     * Display the specified room.
     */
    public function show($id)
    {
        $room = Room::with('roomType')->findOrFail($id);
        $formattedRoom = $this->formatRoomData($room);

        return view('guest.rooms.show', compact('formattedRoom'));
    }

    /**
     * Menerjemahkan data model Database ke struktur Array
     */
    private function formatRoomData($room)
    {
        // Aset gambar dinamis berdasarkan nama Tipe Kamar
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
            'price'       => $rawPrice, // Harga dalam angka (integer)
            'price_formatted' => 'Rp ' . number_format($rawPrice, 0, ',', '.'), // Format: Rp 350.000
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
}
