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
        Schema::table('customers', function (Blueprint $table) {
            // Check if columns exist before adding
            if (!Schema::hasColumn('customers', 'customer_code')) {
                $table->string('customer_code')->unique()->nullable()->after('id');
            }
            if (!Schema::hasColumn('customers', 'address')) {
                $table->text('address')->nullable()->after('email');
            }
            if (!Schema::hasColumn('customers', 'city_id')) {
                $table->unsignedBigInteger('city_id')->nullable()->after('address');
            }
            if (!Schema::hasColumn('customers', 'state_id')) {
                $table->unsignedBigInteger('state_id')->nullable()->after('city_id');
            }
            if (!Schema::hasColumn('customers', 'pincode')) {
                $table->string('pincode')->nullable()->after('state_id');
            }
            if (!Schema::hasColumn('customers', 'password')) {
                $table->string('password')->nullable()->after('pincode');
            }
            if (!Schema::hasColumn('customers', 'profile_image')) {
                $table->string('profile_image')->nullable()->after('password');
            }
            if (!Schema::hasColumn('customers', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('profile_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'customer_code', 'address', 'city_id', 'state_id', 
                'pincode', 'password', 'profile_image', 'status'
            ]);
        });
    }
};
