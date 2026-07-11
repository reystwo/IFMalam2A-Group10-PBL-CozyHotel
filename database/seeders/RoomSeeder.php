<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Seed rooms and room types.
     */
    public function run(): void
    {
        // Create Room Types
        $standard = RoomType::create([
            'name' => 'Standard',
            'price' => 350000,
            'description' => 'Kamar standar nyaman dengan fasilitas dasar untuk menginap yang menyenangkan.',
            'total_rooms' => 20,
        ]);

        $deluxe = RoomType::create([
            'name' => 'Deluxe',
            'price' => 650000,
            'description' => 'Kamar deluxe luas dengan pemandangan kota dan fasilitas premium.',
            'total_rooms' => 15,
        ]);

        $suite = RoomType::create([
            'name' => 'Suite',
            'price' => 1200000,
            'description' => 'Suite mewah dengan ruang tamu terpisah dan pemandangan panorama.',
            'total_rooms' => 8,
        ]);

        $family = RoomType::create([
            'name' => 'Family',
            'price' => 900000,
            'description' => 'Kamar keluarga besar dengan 2 tempat tidur dan area bermain anak.',
            'total_rooms' => 10,
        ]);

        // Create Rooms
        $statuses = ['available', 'occupied', 'maintenance', 'cleaning'];

        // Standard rooms (101-110)
        for ($i = 1; $i <= 10; $i++) {
            Room::create([
                'room_type_id' => $standard->id,
                'room_number' => '10' . $i,
                'status' => $statuses[array_rand(['available', 'available', 'available', 'occupied'])],
            ]);
        }

        // Deluxe rooms (201-208)
        for ($i = 1; $i <= 8; $i++) {
            Room::create([
                'room_type_id' => $deluxe->id,
                'room_number' => '20' . $i,
                'status' => $statuses[array_rand($statuses)],
            ]);
        }

        // Suite rooms (301-305)
        for ($i = 1; $i <= 5; $i++) {
            Room::create([
                'room_type_id' => $suite->id,
                'room_number' => '30' . $i,
                'status' => $statuses[array_rand($statuses)],
            ]);
        }

        // Family rooms (401-406)
        for ($i = 1; $i <= 6; $i++) {
            Room::create([
                'room_type_id' => $family->id,
                'room_number' => '40' . $i,
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
