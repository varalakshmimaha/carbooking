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
        \DB::table('section_types')->insert([
            'key' => 'booking_hero',
            'name' => 'Booking Form Hero',
            'category' => 'Dynamic',
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>',
            'description' => 'The main hero section with car booking search form.',
            'default_settings' => json_encode([
                'title' => 'Book Your Ride',
                'subtitle' => 'Choose your trip type and get started',
                'bg_gradient' => 'from-blue-50 via-indigo-50 to-purple-50'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('section_types')->where('key', 'booking_hero')->delete();
    }
};
