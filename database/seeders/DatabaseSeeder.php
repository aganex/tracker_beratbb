<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BeratBadan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================
        // ADMIN
        // =====================================

        User::create([
            'name' => 'Admin Tracker BB',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        // =====================================
        // DATA USER
        // =====================================

        $users = [

            ['Ahmad Fauzi', 'Laki-laki'],
            ['Budi Santoso', 'Laki-laki'],
            ['Rizky Pratama', 'Laki-laki'],
            ['Dimas Saputra', 'Laki-laki'],
            ['Andi Wijaya', 'Laki-laki'],
            ['Fajar Nugroho', 'Laki-laki'],
            ['Rian Kurniawan', 'Laki-laki'],
            ['Yoga Firmansyah', 'Laki-laki'],
            ['Arif Rahman', 'Laki-laki'],
            ['Reza Maulana', 'Laki-laki'],

            ['Siti Aisyah', 'Perempuan'],
            ['Dewi Lestari', 'Perempuan'],
            ['Putri Maharani', 'Perempuan'],
            ['Nabila Zahra', 'Perempuan'],
            ['Aulia Safitri', 'Perempuan'],
            ['Indah Permata', 'Perempuan'],
            ['Rina Oktaviani', 'Perempuan'],
            ['Nurul Hidayah', 'Perempuan'],
            ['Maya Sari', 'Perempuan'],
            ['Fitri Handayani', 'Perempuan'],
        ];

        foreach ($users as $index => $data) {

            $user = User::create([

                'name' => $data[0],

                'email' => 'user' . ($index + 1) . '@gmail.com',

                'password' => Hash::make('123'),

                'role' => 'user',

                'jenis_kelamin' => $data[1],

                'tinggi_badan' => rand(155, 180),

                'target_berat' => rand(55, 75),

                'aktivitas' => collect([
                    'Tidak Aktif',
                    'Ringan',
                    'Sedang',
                    'Aktif',
                    'Sangat Aktif'
                ])->random(),

                'tanggal_lahir' => now()
                    ->subYears(rand(18, 35))
                    ->format('Y-m-d'),
            ]);

            // =====================================
            // RIWAYAT BERAT BADAN
            // =====================================

            $beratAwal = rand(60, 95);

            for ($i = 0; $i < 5; $i++) {

                BeratBadan::create([

                    'user_id' => $user->id,

                    'berat' => $beratAwal - rand(0, 8),

                    'tanggal' => now()
                        ->subDays($i * 7)
                        ->format('Y-m-d'),
                ]);
            }
        }
    }
}