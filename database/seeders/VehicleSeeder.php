<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'brand' => 'Renault',
                'model' => 'Clio',
                'fuel_type' => 'Petrol',
                'fuel_efficiency' => '16 km/l',
                'year' => 2022,
                'color' => 'Blanc',
                'seats' => 5,
                'engine' => '1.0 Turbo',
                'registration_number' => 'MA-101-AB',
                'mileage' => 18000,
                'daily_rate' => 180.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Peugeot',
                'model' => '208',
                'fuel_type' => 'Petrol',
                'fuel_efficiency' => '15 km/l',
                'year' => 2021,
                'color' => 'Gris',
                'seats' => 5,
                'engine' => '1.2 PureTech',
                'registration_number' => 'MA-202-CD',
                'mileage' => 24000,
                'daily_rate' => 220.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Yaris',
                'fuel_type' => 'Petrol',
                'fuel_efficiency' => '17 km/l',
                'year' => 2023,
                'color' => 'Rouge',
                'seats' => 5,
                'engine' => '1.5',
                'registration_number' => 'MA-303-EF',
                'mileage' => 14000,
                'daily_rate' => 260.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Ford',
                'model' => 'Focus',
                'fuel_type' => 'Diesel',
                'fuel_efficiency' => '18 km/l',
                'year' => 2020,
                'color' => 'Noir',
                'seats' => 5,
                'engine' => '2.0 TDCi',
                'registration_number' => 'MA-404-GH',
                'mileage' => 32000,
                'daily_rate' => 310.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Mercedes',
                'model' => 'C-Class',
                'fuel_type' => 'Diesel',
                'fuel_efficiency' => '19 km/l',
                'year' => 2022,
                'color' => 'Noir',
                'seats' => 5,
                'engine' => '2.0d',
                'registration_number' => 'MA-505-IJ',
                'mileage' => 26000,
                'daily_rate' => 520.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'BMW',
                'model' => '3 Series',
                'fuel_type' => 'Petrol',
                'fuel_efficiency' => '14 km/l',
                'year' => 2023,
                'color' => 'Bleu',
                'seats' => 5,
                'engine' => '2.0',
                'registration_number' => 'MA-606-KL',
                'mileage' => 21000,
                'daily_rate' => 650.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($vehicles as $vehicle) {
            DB::table('vehicles')->updateOrInsert(
                ['registration_number' => $vehicle['registration_number']],
                $vehicle
            );
        }
    }
}
