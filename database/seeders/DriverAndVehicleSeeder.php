<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleType;

class DriverAndVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have vehicle types
        $types = VehicleType::all();
        if ($types->count() === 0) {
            $this->call(VehicleTypeSeeder::class);
            $types = VehicleType::all();
        }

        $drivers = [
            [
                'name' => 'John Doe',
                'email' => 'john.driver@example.com',
                'mobile' => '9876543210',
                'password' => 'password123',
                'license_number' => 'KA0120230001',
                'verification_status' => 'Verified',
                'status' => 'active',
                'driver_code' => 'DRV001'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.driver@example.com',
                'mobile' => '9876543211',
                'password' => 'password123',
                'license_number' => 'KA0120230002',
                'verification_status' => 'Verified',
                'status' => 'active',
                'driver_code' => 'DRV002'
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike.driver@example.com',
                'mobile' => '9876543212',
                'password' => 'password123',
                'license_number' => 'KA0120230003',
                'verification_status' => 'Verified',
                'status' => 'active',
                'driver_code' => 'DRV003'
            ],
             [
                'name' => 'Sara Ali',
                'email' => 'sara.driver@example.com',
                'mobile' => '9876543213',
                'password' => 'password123',
                'license_number' => 'KA0120230004',
                'verification_status' => 'Verified',
                'status' => 'active',
                'driver_code' => 'DRV004'
            ],
             [
                'name' => 'Davil Miller',
                'email' => 'david.driver@example.com',
                'mobile' => '9876543214',
                'password' => 'password123',
                'license_number' => 'KA0120230005',
                'verification_status' => 'Verified',
                'status' => 'active',
                'driver_code' => 'DRV005'
            ],
        ];

        foreach ($drivers as $index => $driverData) {
            $driver = Driver::create($driverData);
            
            // Assign a vehicle to each driver
            // Cycle through types: Mini, Sedan, SUV, etc.
            $type = $types[$index % $types->count()];

            Vehicle::create([
                'driver_id' => $driver->id,
                'vehicle_type_id' => $type->id,
                'name' => $type->name . ' - ' . $driver->name,
                'model' => 'Model ' . (2020 + $index),
                'plate_number' => 'KA-01-AB-100' . $index,
                'status' => 'active',
                'cab_name' => $type->name,
                'fuel_type' => 'Petrol',
                'seating_capacity' => $type->seating_capacity,
                'car_permit_verified' => 'Verified',
                'fitness_certificate_verified' => 'Verified',
                'insurance_image_verified' => 'Verified',
                'rc_book_image_verified' => 'Verified',
                'vehicle_image_verified' => 'Verified'
            ]);
        }
    }
}
