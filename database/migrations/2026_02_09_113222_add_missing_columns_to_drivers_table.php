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
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('drivers', 'mobile')) {
                $table->string('mobile')->nullable()->after('name');
            }
            if (!Schema::hasColumn('drivers', 'email')) {
                $table->string('email')->nullable()->after('mobile');
            }
            if (!Schema::hasColumn('drivers', 'address')) {
                $table->text('address')->nullable()->after('email');
            }
            if (!Schema::hasColumn('drivers', 'state_id')) {
                $table->unsignedBigInteger('state_id')->nullable()->after('address');
            }
            if (!Schema::hasColumn('drivers', 'city_id')) {
                $table->unsignedBigInteger('city_id')->nullable()->after('state_id');
            }
            if (!Schema::hasColumn('drivers', 'wallet_amount')) {
                $table->decimal('wallet_amount', 10, 2)->default(0)->after('city_id');
            }
            if (!Schema::hasColumn('drivers', 'password')) {
                $table->string('password')->nullable()->after('wallet_amount');
            }
            if (!Schema::hasColumn('drivers', 'verification_status')) {
                $table->enum('verification_status', ['verified', 'not_verified'])->default('not_verified')->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn([
                'mobile', 'email', 'address', 'state_id', 'city_id', 
                'wallet_amount', 'password', 'verification_status'
            ]);
        });
    }
};
