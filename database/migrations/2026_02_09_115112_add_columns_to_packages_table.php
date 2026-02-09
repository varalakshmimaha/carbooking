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
        Schema::table('packages', function (Blueprint $table) {
            // Check if columns exist before adding
            if (!Schema::hasColumn('packages', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('packages', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('packages', 'amount')) {
                $table->decimal('amount', 10, 2)->after('description');
            }
            if (!Schema::hasColumn('packages', 'days')) {
                $table->integer('days')->after('amount');
            }
            if (!Schema::hasColumn('packages', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('days');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['name', 'description', 'amount', 'days', 'status']);
        });
    }
};
