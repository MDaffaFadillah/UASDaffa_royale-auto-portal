<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LuxuryCar;

class LuxuryCarSeeder extends Seeder
{
    public function run(): void
    {
        LuxuryCar::create([
            'model_name' => 'Rolls-Royce Phantom',
            'tag_line' => 'The Whispering Giant',
            'description' => 'Phantom is the ultimate expression of Rolls-Royce magic, offering a magic carpet ride with unmatched acoustic isolation and bespoke elegance.',
            'engine_specs' => [
                'engine' => '6.75L V12 Twin-Turbo',
                'power' => '563 bhp',
                '0-100 km/h' => '5.3 seconds'
            ],
            'gallery_images' => ['phantom.webp', 'phantomban.webp', 'cq5dam.web.1920.webp', 'phantom centanary.webp'],
            'indicative_price' => 25000000000.00,
            'availability_status' => 'available',
        ]);

        LuxuryCar::create([
            'model_name' => 'Rolls-Royce Cullinan Series II',
            'tag_line' => 'Effortless, Everywhere',
            'description' => 'The first all-terrain SUV from Rolls-Royce makes luxury off-road travel a reality for the first time.',
            'engine_specs' => [
                'engine' => '6.75L V12 Twin-Turbo',
                'power' => '592 bhp',
                '0-100 km/h' => '5.0 seconds'
            ],
            'gallery_images' => ['Cullinan series II.jpg', 'cullinandepan.jpg', 'cullinanbody.png', 'cullinan series II(2).jpg', 'cullinansamping1.jpg', 'cullinansamping2.jpg'],
            'indicative_price' => 22000000000.00,
            'availability_status' => 'available',
        ]);

        LuxuryCar::create([
            'model_name' => 'Rolls-Royce Spectre',
            'tag_line' => 'A Prophecy Fulfilled',
            'description' => 'Spectre is the first fully electric Rolls-Royce, leading the marque into a new era of ultra-luxury zero-emission driving.',
            'engine_specs' => [
                'engine' => 'Dual Motor Electric',
                'power' => '577 bhp',
                'range' => '520 km (WLTP)'
            ],
            'gallery_images' => ['SPECTRE(1).webp', 'sPECTRE(2).webp', 'sPECTRE(3).png', 'SPECTRE(40.png'],
            'indicative_price' => 20000000000.00,
            'availability_status' => 'bespoke_in_progress',
        ]);
    }
}