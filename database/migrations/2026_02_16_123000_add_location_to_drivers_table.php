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
        Schema::table('drivers', function (Blueprint $table) {
            if (!Schema::hasColumn('drivers', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('status');
            }
            if (!Schema::hasColumn('drivers', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
            if (!Schema::hasColumn('drivers', 'is_online')) {
                $table->boolean('is_online')->default(false)->after('longitude');
            }
            if (!Schema::hasColumn('drivers', 'current_location_address')) {
                $table->string('current_location_address')->nullable()->after('is_online');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'is_online', 'current_location_address']);
        });
    }
};
