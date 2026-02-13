<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Local 4hrs/40km',
                'days' => 1,
                'amount' => 1200,
                'description' => 'Half-day city rental for shopping or short visits.',
                'status' => 'active'
            ],
            [
                'name' => 'Local 8hrs/80km',
                'days' => 1,
                'amount' => 2200,
                'description' => 'Full-day city rental for business or sightseeing.',
                'status' => 'active'
            ],
            [
                'name' => 'Airport Transfer',
                'days' => 1,
                'amount' => 800,
                'description' => 'Fixed price airport pickup or drop.',
                'status' => 'active'
            ],
            [
                'name' => 'Outstation Roundtrip (Min 300km)',
                'days' => 2,
                'amount' => 4500,
                'description' => 'Weekend getaway to nearby destinations.',
                'status' => 'active'
            ],
            [
                'name' => 'Pilgrimage Special (3 Days)',
                'days' => 3,
                'amount' => 7500,
                'description' => 'Visit famous temples with comfortable travel.',
                'status' => 'active'
            ],
        ];

        foreach ($packages as $package) {
            $package['slug'] = Str::slug($package['name']);
            Package::updateOrCreate(
                ['name' => $package['name']],
                $package
            );
        }
    }
}
