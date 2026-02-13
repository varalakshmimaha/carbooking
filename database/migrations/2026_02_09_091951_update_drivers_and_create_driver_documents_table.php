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
            if (!Schema::hasColumn('drivers', 'driver_code')) {
                $table->string('driver_code')->unique()->after('id');
            }
            if (!Schema::hasColumn('drivers', 'email')) {
                $table->string('email')->nullable()->unique()->after('name');
            }
            if (Schema::hasColumn('drivers', 'phone') && !Schema::hasColumn('drivers', 'mobile')) {
                $table->renameColumn('phone', 'mobile');
            }
        });

        Schema::table('drivers', function (Blueprint $table) {
            if (!Schema::hasColumn('drivers', 'address')) {
                $table->text('address')->nullable()->after(Schema::hasColumn('drivers', 'mobile') ? 'mobile' : 'phone');
            }
            if (!Schema::hasColumn('drivers', 'state_id')) {
                $table->foreignId('state_id')->nullable()->constrained()->after('address');
            }
            if (!Schema::hasColumn('drivers', 'city_id')) {
                $table->foreignId('city_id')->nullable()->constrained()->after('state_id');
            }
            if (!Schema::hasColumn('drivers', 'wallet_amount')) {
                $table->decimal('wallet_amount', 10, 2)->default(0)->after('city_id');
            }
            if (!Schema::hasColumn('drivers', 'password')) {
                $table->string('password')->after('wallet_amount');
            }
            if (!Schema::hasColumn('drivers', 'verification_status')) {
                $table->enum('verification_status', ['verified', 'not_verified'])->default('not_verified')->after('password');
            }
        });

        if (!Schema::hasTable('driver_documents')) {
            Schema::create('driver_documents', function (Blueprint $table) {
                $table->id();
                $table->foreignId('driver_id')->constrained()->onDelete('cascade');
                $table->string('driver_photo')->nullable();
                $table->string('aadhar_front')->nullable();
                $table->string('aadhar_back')->nullable();
                $table->string('dl_front')->nullable();
                $table->string('dl_back')->nullable();
                $table->string('health_certificate')->nullable();
                $table->string('upi_qr_code')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_documents');
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn([
                'driver_code', 'email', 'address', 'state_id', 'city_id', 
                'wallet_amount', 'password', 'verification_status'
            ]);
            $table->renameColumn('mobile', 'phone');
        });
    }
};
