<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@gmail.com',
                'phone' => '+62 812 3456 7890',
                'gender' => 'male',
                'address' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                'id_number' => '3175012345670001',
                'status' => 'active',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@gmail.com',
                'phone' => '+62 813 9876 5432',
                'gender' => 'female',
                'address' => 'Jl. Gatot Subroto No. 12, Bandung',
                'id_number' => '3273012345670002',
                'status' => 'active',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@yahoo.com',
                'phone' => '+62 857 1234 5678',
                'gender' => 'male',
                'address' => 'Jl. Malioboro No. 78, Yogyakarta',
                'id_number' => '3402012345670003',
                'status' => 'active',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@outlook.com',
                'phone' => '+62 878 8765 4321',
                'gender' => 'female',
                'address' => 'Jl. Diponegoro No. 33, Surabaya',
                'id_number' => '3578012345670004',
                'status' => 'active',
            ],
            [
                'name' => 'Reza Mahendra',
                'email' => 'reza.mahendra@gmail.com',
                'phone' => '+62 821 5678 1234',
                'gender' => 'male',
                'address' => 'Jl. Imam Bonjol No. 21, Semarang',
                'id_number' => '3374012345670005',
                'status' => 'active',
            ],
            [
                'name' => 'Putri Ayu Wulandari',
                'email' => 'putri.ayu@gmail.com',
                'phone' => '+62 838 4321 8765',
                'gender' => 'female',
                'address' => 'Jl. Teuku Umar No. 56, Denpasar',
                'id_number' => '5171012345670006',
                'status' => 'inactive',
            ],
            [
                'name' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@gmail.com',
                'phone' => '+62 896 1122 3344',
                'gender' => 'male',
                'address' => 'Jl. Ahmad Yani No. 89, Medan',
                'id_number' => '1271012345670007',
                'status' => 'active',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
