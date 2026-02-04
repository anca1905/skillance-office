<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // 1. BUAT AKUN LOGIN (CEO)
        User::create([
            'name' => 'Arsyad',
            'email' => 'arsyad@skillance.id',
            'password' => Hash::make('password123'), // Password login
        ]);

        // 2. INPUT DATA PROJECT REAL (Sesuai Chat Anda)
        $projects = [
            [
                'name' => 'Aplikasi Manajemen Laundry',
                'platform' => 'Android Mobile',
                'client_name' => 'Putri',
                'client_contact' => '6281543217636',
                'client_institution' => 'Mahasiswa',
                'deadline' => '2026-02-15',
                'status' => 'Development',
                'payment_status' => 'DP 50%',
                'demo_link' => null, // Gk ada link demo
                'created_at' => now(),
            ],
            [
                'name' => 'SIG Pemetaan Jalan Rusak',
                'platform' => 'Web GIS (Bombana)',
                'client_name' => 'Nurliana Saputri',
                'client_contact' => '6282291407216',
                'client_institution' => 'Mahasiswa',
                'deadline' => '2026-02-20',
                'status' => 'Development',
                'payment_status' => 'Belum Bayar',
                'demo_link' => null, // Belum ada link
                'created_at' => now(),
            ],
            [
                'name' => 'Sistem Absensi QR Code',
                'platform' => 'Web App',
                'client_name' => 'Amanda',
                'client_contact' => '6282348624473',
                'client_institution' => 'PT Damai Jaya Lestari',
                'deadline' => '2026-02-25',
                'status' => 'Testing',
                'payment_status' => 'Lunas',
                'demo_link' => 'https://project.gamer.gd/amanda/',
                'created_at' => now(),
            ],
            [
                'name' => 'SIM Antrian Klinik Gigi',
                'platform' => 'Web App',
                'client_name' => 'Arifa',
                'client_contact' => '6285823779751',
                'client_institution' => 'Klinik Gigi',
                'deadline' => '2026-02-28',
                'status' => 'Selesai',
                'payment_status' => 'Lunas',
                'demo_link' => 'https://project.gamer.gd/arifa/',
                'created_at' => now(),
            ],
            [
                'name' => 'Sistem Pakar Kakao (Forward Chaining)',
                'platform' => 'Web Expert System',
                'client_name' => 'Gea',
                'client_contact' => '6282290298955',
                'client_institution' => 'Mahasiswa',
                'deadline' => '2026-03-01',
                'status' => 'Selesai',
                'payment_status' => 'Lunas',
                'demo_link' => 'https://project.gamer.gd/gea/',
                'created_at' => now(),
            ],
        ];

        DB::table('projects')->insert($projects);

        // 3. INPUT DATA MARKETING (Leads)
        DB::table('leads')->insert([
            [
                'institution' => 'Dinas PU Kolaka',
                'project_name' => 'Proyek Arsip Digital',
                'contact_person' => '0812-3456-7890',
                'potential_value' => 150000000,
                'status' => 'Presentasi Awal',
                'created_at' => now(),
            ],
            [
                'institution' => 'PT. Tambang Sejahtera',
                'project_name' => 'Company Profile Web',
                'contact_person' => '0811-9988-7766',
                'potential_value' => 25000000,
                'status' => 'Nego Harga',
                'created_at' => now(),
            ]
        ]);

        // 4. INPUT DATA KEUANGAN (Transactions)
        DB::table('transactions')->insert([
            [
                'transaction_date' => '2026-02-01',
                'description' => 'Pelunasan Sistem Pakar',
                'category' => 'Klien: Gea',
                'type' => 'income',
                'amount' => 2500000,
                'created_at' => now(),
            ],
            [
                'transaction_date' => '2026-02-02',
                'description' => 'Bayar Hosting & Domain',
                'category' => 'Niagahoster',
                'type' => 'expense',
                'amount' => 1200000,
                'created_at' => now(),
            ]
        ]);
    }
}
