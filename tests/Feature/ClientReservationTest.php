<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_user_can_access_admin_panel(): void
    {
        $employee = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $this->assertTrue($employee->canAccessPanel(app(\Filament\Panel::class)));
    }

    public function test_reservation_creates_customer_profile_from_reservation_data(): void
    {
        $vehicle = Vehicle::create([
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'fuel_type' => 'Petrol',
            'fuel_efficiency' => '15',
            'year' => 2024,
            'color' => 'White',
            'seats' => 5,
            'engine' => '1.8',
            'registration_number' => 'TEST-CLIENT-001',
            'mileage' => 25000,
            'daily_rate' => 8000,
            'is_available' => true,
        ]);

        $reservation = Reservation::create([
            'user_id' => User::factory()->create()->id,
            'vehicle_id' => $vehicle->vehicle_id,
            'start_date' => '2026-09-10',
            'end_date' => '2026-09-12',
            'total_cost' => 8000,
            'status' => 'pending',
            'customer_name' => 'Youssef El Idrissi',
            'passport_number' => 'AB123456',
            'phone_number' => '+212600000000',
        ]);

        $this->assertNotNull($reservation->customer_id);
        $this->assertDatabaseHas('customers', [
            'full_name' => 'Youssef El Idrissi',
            'passport_number' => 'AB123456',
            'phone_number' => '+212600000000',
        ]);
        $this->assertInstanceOf(Customer::class, $reservation->customer);
    }
}
