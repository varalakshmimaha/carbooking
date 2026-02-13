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
            if (!Schema::hasColumn('bookings', 'end_date')) {
                $table->dateTime('end_date')->nullable()->after('book_date');
            }
            if (!Schema::hasColumn('bookings', 'no_of_travelers')) {
                $table->integer('no_of_travelers')->default(1)->after('end_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['end_date', 'no_of_travelers']);
        });
    }
};
