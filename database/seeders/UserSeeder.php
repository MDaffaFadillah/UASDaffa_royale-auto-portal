<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Showroom
        User::create([
            'full_name' => 'Alexander Reeve',
            'email' => 'admin@royaleauto.com',
            'password' => Hash::make('luxury123'), 
            'phone_number' => '+628111111111',
            'role' => 'admin',
        ]);

        // 2. Akun Pelanggan VIP
        User::create([
            'full_name' => 'Isabella Chen',
            'email' => 'isabella@vip.com',
            'password' => Hash::make('luxury123'),
            'phone_number' => '+628222222222',
            'role' => 'vip',
        ]);
    }
}