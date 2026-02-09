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
            $table->string('driver_code')->unique()->after('id');
            $table->string('email')->nullable()->unique()->after('name');
            $table->renameColumn('phone', 'mobile');
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->text('address')->nullable()->after('mobile');
            $table->foreignId('state_id')->nullable()->constrained()->after('address');
            $table->foreignId('city_id')->nullable()->constrained()->after('state_id');
            $table->decimal('wallet_amount', 10, 2)->default(0)->after('city_id');
            $table->string('password')->after('wallet_amount');
            $table->enum('verification_status', ['verified', 'not_verified'])->default('not_verified')->after('password');
        });

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
