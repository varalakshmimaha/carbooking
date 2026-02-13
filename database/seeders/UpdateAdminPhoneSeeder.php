<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateAdminPhoneSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@example.com')->first();
        if ($admin) {
            $admin->phone = '8888888888';
            $admin->save();
            $this->command->info('Admin phone updated to 8888888888');
        } else {
            $this->command->warn('Admin user not found. Creating new admin.');
            User::create([
                'name' => 'Admin2',
                'email' => 'admin2@example.com',
                'phone' => '8888888888',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]);
            $this->command->info('New Admin created with phone 8888888888');
        }
    }
}
