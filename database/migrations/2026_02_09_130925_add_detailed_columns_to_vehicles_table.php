<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreignId('driver_id')->nullable()->after('id')->constrained('drivers')->onDelete('set null');
            $table->string('cab_name')->nullable()->after('name');
            $table->string('model_year')->nullable()->after('model');
            $table->string('cab_number')->nullable()->after('plate_number');
            $table->string('chassis_number')->nullable()->after('cab_number');
            $table->string('cab_color')->nullable()->after('chassis_number');
            $table->enum('with_carrier', ['Yes', 'No'])->default('No')->after('cab_color');
            $table->string('fuel_type')->default('Petrol')->after('with_carrier');
            $table->integer('seating_capacity')->nullable()->after('fuel_type');
            
            // Images
            $table->string('vehicle_image')->nullable();
            $table->string('rc_book_image')->nullable();
            $table->string('rc_book_back_image')->nullable();
            $table->string('insurance_image')->nullable();
            $table->string('puc_image')->nullable();
            $table->string('fitness_certificate')->nullable();
            $table->string('car_permit')->nullable();

            // Verification Statuses
            $table->enum('vehicle_image_verified', ['Verified', 'Unverified', 'Pending'])->default('Pending');
            $table->enum('rc_book_image_verified', ['Verified', 'Unverified', 'Pending'])->default('Pending');
            $table->enum('rc_book_back_image_verified', ['Verified', 'Unverified', 'Pending'])->default('Pending');
            $table->enum('insurance_image_verified', ['Verified', 'Unverified', 'Pending'])->default('Pending');
            $table->enum('puc_image_verified', ['Verified', 'Unverified', 'Pending'])->default('Pending');
            $table->enum('fitness_certificate_verified', ['Verified', 'Unverified', 'Pending'])->default('Pending');
            $table->enum('car_permit_verified', ['Verified', 'Unverified', 'Pending'])->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['driver_id']);
            $table->dropColumn([
                'driver_id', 'cab_name', 'model_year', 'cab_number', 'chassis_number', 
                'cab_color', 'with_carrier', 'fuel_type', 'seating_capacity',
                'vehicle_image', 'rc_book_image', 'rc_book_back_image', 'insurance_image', 
                'puc_image', 'fitness_certificate', 'car_permit',
                'vehicle_image_verified', 'rc_book_image_verified', 'rc_book_back_image_verified',
                'insurance_image_verified', 'puc_image_verified', 'fitness_certificate_verified',
                'car_permit_verified'
            ]);
        });
    }
};
