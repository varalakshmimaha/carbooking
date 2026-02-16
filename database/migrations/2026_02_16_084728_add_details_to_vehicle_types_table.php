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
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->string('transmission')->nullable()->default('Manual')->after('name'); // Auto, Manual
            $table->string('fuel_type')->nullable()->default('Petrol')->after('transmission'); // Petrol, Diesel, Electric
            $table->string('model_year')->nullable()->default('2023')->after('fuel_type');
            $table->string('category')->nullable()->default('Standard')->after('model_year'); // e.g. US Standard, Premium
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->dropColumn(['transmission', 'fuel_type', 'model_year', 'category']);
        });
    }
};
