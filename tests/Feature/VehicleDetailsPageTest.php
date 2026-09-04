<?php

namespace Tests\Feature;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleDetailsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_vehicle_detail_page_loads_even_without_images(): void
    {
        Vehicle::create([
            'brand' => 'Renault',
            'model' => 'Clio',
            'fuel_type' => 'Petrol',
            'fuel_efficiency' => '16',
            'year' => 2024,
            'color' => 'White',
            'seats' => 5,
            'engine' => '1.0',
            'registration_number' => 'TEST-DETAIL-001',
            'mileage' => 15000,
            'daily_rate' => 200.00,
            'is_available' => true,
        ]);

        $response = $this->get('/vehicles/1');

        $response->assertOk();
        $response->assertSee('Smart Manager Car');
    }
}
