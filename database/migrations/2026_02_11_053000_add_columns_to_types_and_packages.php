<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add columns to vehicle_types
        Schema::table('vehicle_types', function (Blueprint $table) {
            if (!Schema::hasColumn('vehicle_types', 'status')) {
                $table->string('status')->default('active')->after('name');
            }
            if (!Schema::hasColumn('vehicle_types', 'seating_capacity')) {
                $table->integer('seating_capacity')->default(4)->after('name');
            }
            if (!Schema::hasColumn('vehicle_types', 'base_fare')) {
                $table->decimal('base_fare', 10, 2)->default(0)->after('seating_capacity');
            }
            if (!Schema::hasColumn('vehicle_types', 'per_km_rate')) {
                $table->decimal('per_km_rate', 10, 2)->default(0)->after('base_fare');
            }
            if (!Schema::hasColumn('vehicle_types', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('vehicle_types', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
        });

        // Add columns to packages
        Schema::table('packages', function (Blueprint $table) {
            if (!Schema::hasColumn('packages', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('packages', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
            if (!Schema::hasColumn('packages', 'description')) {
                $table->text('description')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('packages', 'days')) {
                $table->integer('days')->default(1)->after('description');
            }
            if (!Schema::hasColumn('packages', 'amount')) {
                $table->decimal('amount', 10, 2)->default(0)->after('days');
            }
            if (!Schema::hasColumn('packages', 'status')) {
                $table->string('status')->default('active')->after('amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->dropColumn(['status', 'seating_capacity', 'base_fare', 'per_km_rate', 'description', 'image']);
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['name', 'slug', 'description', 'days', 'amount', 'status']);
        });
    }
};
