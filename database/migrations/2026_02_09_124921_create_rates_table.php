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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types')->onDelete('cascade');
            $table->decimal('default_rate', 10, 2);
            $table->decimal('round_trip_rate', 10, 2)->nullable();
            $table->decimal('local_12_hours_rate', 10, 2)->nullable();
            $table->decimal('local_8_hours_rate', 10, 2)->nullable();
            $table->decimal('extra_km_charge', 10, 2)->default(0);
            $table->integer('daily_max_km')->default(0);
            $table->decimal('night_driving_charge', 10, 2)->default(0);
            $table->decimal('driver_allowance', 10, 2)->default(0);
            $table->string('gear_type')->default('Manual');
            $table->string('fuel_type')->default('Diesel');
            $table->string('steering')->default('Power');
            $table->string('capacity')->nullable();
            $table->string('image')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->text('inclusions')->nullable();
            $table->text('exclusions')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
