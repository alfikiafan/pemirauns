<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $email = $this->command->ask('Enter super admin email', 'admin@pemira.com');
        $password = $this->command->ask('Enter super admin password', 'admin123');

        $superadmin = User::create([
            'name' => 'Super Admin',
            'nim' => '0',
            'email' => $email,
            'password' => Hash::make($password),
            'batch' => 0,
            'faculty' => '',
            'user_status' => 'approved',
            'email_verified_at' => now(),
        ]);

        // Attach role to user
        $superadmin->roles()->attach($superadminRole->id);
    }
}