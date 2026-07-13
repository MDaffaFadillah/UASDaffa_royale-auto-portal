<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VipBooking;
use App\Models\User;
use App\Models\LuxuryCar;
use Carbon\Carbon;

class VipBookingSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari Isabella dan Mobil Spectre
        $isabella = User::where('email', 'isabella@vip.com')->first();
        $spectre = LuxuryCar::where('model_name', 'Rolls-Royce Spectre')->first();

        if ($isabella && $spectre) {
            VipBooking::create([
                'user_id' => $isabella->id,
                'car_id' => $spectre->id,
                'booking_type' => 'test_drive',
                'preferred_datetime' => Carbon::now()->addDays(7),
                'status' => 'confirmed',
                'notes' => 'Isabella requests a sunset test drive along the coastal route.',
                'admin_notes' => 'Route cleared. Personal Client Advisor assigned.',
            ]);
        }
    }
}