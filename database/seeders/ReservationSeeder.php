<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@example.com')->firstOrFail();
        $vehicles = Vehicle::orderBy('vehicle_id')->get();

        $customers = [
            [
                'full_name' => 'Salma Benali',
                'passport_number' => 'MA1234567',
                'phone_number' => '+212612345678',
            ],
            [
                'full_name' => 'Youssef El Idrissi',
                'passport_number' => 'MA2345678',
                'phone_number' => '+212623456789',
            ],
            [
                'full_name' => 'Hajar Amrani',
                'passport_number' => 'MA3456789',
                'phone_number' => '+212634567890',
            ],
        ];

        foreach ($vehicles as $index => $vehicle) {
            $customerData = $customers[$index % count($customers)];
            $customer = Customer::firstOrCreate(
                ['passport_number' => $customerData['passport_number']],
                $customerData
            );

            $startDate = now()->subDays(25 - ($index * 4))->startOfDay();
            $endDate = (clone $startDate)->addDays(3);

            Reservation::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'customer_id' => $customer->id,
                    'vehicle_id' => $vehicle->vehicle_id,
                    'start_date' => $startDate->toDateString(),
                ],
                [
                    'customer_name' => $customer->full_name,
                    'passport_number' => $customer->passport_number,
                    'phone_number' => $customer->phone_number,
                    'end_date' => $endDate->toDateString(),
                    'total_cost' => round($vehicle->daily_rate * 4, 2),
                    'status' => $index % 2 === 0 ? 'confirmed' : 'pending',
                ]
            );
        }
    }
}