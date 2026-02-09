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
        if (!Schema::hasColumn('drivers', 'driver_code')) {
            Schema::table('drivers', function (Blueprint $table) {
                $table->string('driver_code')->nullable()->after('id');
            });

            // Generate driver codes for existing drivers
            $drivers = DB::table('drivers')->get();
            foreach ($drivers as $driver) {
                DB::table('drivers')
                    ->where('id', $driver->id)
                    ->update(['driver_code' => 'DRV' . str_pad($driver->id, 5, '0', STR_PAD_LEFT)]);
            }

            // Now make it unique and not nullable
            Schema::table('drivers', function (Blueprint $table) {
                $table->string('driver_code')->unique()->nullable(false)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('driver_code');
        });
    }
};
