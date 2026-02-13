<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('vehicle_type_id')->nullable()->constrained()->after('vehicle_id');
            $table->foreignId('package_id')->nullable()->constrained()->after('vehicle_type_id');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['vehicle_type_id']);
            $table->dropColumn('vehicle_type_id');
            $table->dropForeign(['package_id']);
            $table->dropColumn('package_id');
        });
    }
};
