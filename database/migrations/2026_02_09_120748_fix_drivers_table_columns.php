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
            // Make columns nullable to avoid "no default value" errors
            if (Schema::hasColumn('drivers', 'phone')) {
                $table->string('phone')->nullable()->change();
            }
            if (Schema::hasColumn('drivers', 'license_number')) {
                $table->string('license_number')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            if (Schema::hasColumn('drivers', 'phone')) {
                $table->string('phone')->nullable(false)->change();
            }
            if (Schema::hasColumn('drivers', 'license_number')) {
                $table->string('license_number')->nullable(false)->change();
            }
        });
    }
};
