<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashboardDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vehicles
        $vehicle1 = \App\Models\Vehicle::create(['name' => 'Toyota Innova', 'model' => '2023', 'plate_number' => 'KA-01-MH-1234', 'status' => 'active']);
        $vehicle2 = \App\Models\Vehicle::create(['name' => 'Maruti Swift', 'model' => '2022', 'plate_number' => 'KA-01-MH-5678', 'status' => 'active']);
        \App\Models\Vehicle::create(['name' => 'Mahindra XUV700', 'model' => '2024', 'plate_number' => 'KA-01-MH-9012', 'status' => 'inactive']);

        // Drivers
        $driver1 = \App\Models\Driver::create(['name' => 'Rajesh Kumar', 'phone' => '9876543210', 'license_number' => 'DL-1234567890', 'status' => 'active']);
        $driver2 = \App\Models\Driver::create(['name' => 'Suresh Raina', 'phone' => '9876543211', 'license_number' => 'DL-0987654321', 'status' => 'active']);
        \App\Models\Driver::create(['name' => 'Mahesh Babu', 'phone' => '9876543212', 'license_number' => 'DL-5555555555', 'status' => 'active']);

        // Customers
        $customer1 = \App\Models\Customer::create(['name' => 'John Doe', 'phone' => '9999888877', 'email' => 'john@example.com']);
        $customer2 = \App\Models\Customer::create(['name' => 'Jane Smith', 'phone' => '9999777766', 'email' => 'jane@example.com']);

        // Bookings
        // Upcoming Bookings
        \App\Models\Booking::create([
            'customer_id' => $customer1->id,
            'driver_id' => $driver1->id,
            'vehicle_id' => $vehicle1->id,
            'rental_type' => 'Round Trip',
            'pickup_location' => 'Airport',
            'drop_location' => 'Hotel Taj',
            'book_date' => now()->addDays(2),
            'amount' => 1500.00,
            'status' => 'Confirmed'
        ]);

        \App\Models\Booking::create([
            'customer_id' => $customer2->id,
            'driver_id' => null,
            'vehicle_id' => null,
            'rental_type' => 'Local',
            'pickup_location' => 'City Center',
            'drop_location' => 'Railway Station',
            'book_date' => now()->addDays(1),
            'amount' => 500.00,
            'status' => 'Pending'
        ]);

        // Running Bookings (using 'Confirmed' or a specific logic, let's say 'Confirmed' and date is today)
        \App\Models\Booking::create([
            'customer_id' => $customer1->id,
            'driver_id' => $driver2->id,
            'vehicle_id' => $vehicle2->id,
            'rental_type' => 'One Way',
            'pickup_location' => 'Koramangala',
            'drop_location' => 'Whitefield',
            'book_date' => now(),
            'amount' => 1200.00,
            'status' => 'Confirmed'
        ]);

        \App\Models\Booking::create([
            'customer_id' => $customer2->id,
            'driver_id' => $driver1->id,
            'vehicle_id' => $vehicle1->id,
            'rental_type' => 'Round Trip',
            'pickup_location' => 'Indiranagar',
            'drop_location' => 'Airport',
            'book_date' => now()->subHours(2),
            'amount' => 800.00,
            'status' => 'Completed'
        ]);
    }
}
