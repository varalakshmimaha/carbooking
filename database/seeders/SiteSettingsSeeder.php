<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Company Settings
        Setting::set('company_name', 'Raitha Okkuta', 'company');
        Setting::set('company_address', 'Near Taluk Office, Main Road, Narasimharajpur - 577134', 'company');
        Setting::set('company_email', 'raitha.okkuta@gmail.com', 'company');
        Setting::set('company_phone', '9342361210', 'company');

        // System Settings
        Setting::set('site_name', 'Raitha Okkuta', 'system');
        
        $this->command->info('Site settings seeded successfully!');
    }
}
