<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CheckAdminSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@example.com')->first();
        
        if (!$admin) {
            // Try finding any admin
            $admin = User::where('is_admin', true)->first();
        }

        if ($admin) {
            $this->command->info('Admin Found: ' . $admin->name . ' (' . $admin->email . ')');
            
            if (empty($admin->phone)) {
                $this->command->warn('Admin has no phone. Setting to 7777777777');
                try {
                    $admin->phone = '7777777777';
                    $admin->password = bcrypt('password');
                    $admin->save();
                    $this->command->info('Admin Phone set to 7777777777');
                } catch (\Exception $e) {
                     $this->command->error('Could not set phone: ' . $e->getMessage());
                }
            } else {
                $this->command->info('Admin Phone is: ' . $admin->phone);
                $admin->password = bcrypt('password');
                $admin->save();
                $this->command->info('Admin Password reset to "password"');
            }
        } else {
            $this->command->error('No Admin User Found!');
             // Create one
             try {
                User::create([
                    'name' => 'Super Admin',
                    'email' => 'superadmin@example.com',
                    'phone' => '7777777777',
                    'password' => bcrypt('password'),
                    'is_admin' => true,
                ]);
                $this->command->info('Created Super Admin with phone 7777777777');
             } catch (\Exception $e) {
                $this->command->error('Failed to create admin: ' . $e->getMessage());
             }
        }
    }
}
