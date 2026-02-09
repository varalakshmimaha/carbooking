<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        // Seed some initial data
        $states = [
            'Andhra Pradesh' => ['Visakhapatnam', 'Vijayawada', 'Guntur', 'Nellore'],
            'Karnataka' => ['Bangalore', 'Mysore', 'Hubli', 'Mangalore'],
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Nashik'],
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai', 'Trichy'],
            'Telangana' => ['Hyderabad', 'Warangal', 'Nizamabad', 'Karimnagar'],
            'Kerala' => ['Thiruvananthapuram', 'Kochi', 'Kozhikode', 'Thrissur'],
            'Delhi' => ['New Delhi', 'Delhi'],
        ];

        foreach ($states as $stateName => $cities) {
            $stateId = DB::table('states')->insertGetId([
                'name' => $stateName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($cities as $city) {
                DB::table('cities')->insert([
                    'state_id' => $stateId,
                    'name' => $city,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
        Schema::dropIfExists('states');
    }
};
