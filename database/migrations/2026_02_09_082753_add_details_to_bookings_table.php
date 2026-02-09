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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dateTime('end_date')->nullable()->after('book_date');
            $table->json('drop_locations')->nullable()->after('drop_location');
            $table->string('verification_status')->default('Not Verified')->after('status');
            $table->string('cab_type')->nullable()->after('rental_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['end_date', 'drop_locations', 'verification_status', 'cab_type']);
        });
    }
};
