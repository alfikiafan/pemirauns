<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);

        $superadmin = User::create([
            'name' => 'Super Admin',
            'nim' => '0',
            'email' => 'admin@pemira.com',
            'password' => bcrypt('admin123'),
            'batch' => 2020,
            'faculty' => 'FATISDA',
            'user_status' => 'approved',
            'email_verified_at' => now(),
        ]);

        // Attach role to user
        $superadmin->roles()->attach($superadminRole->id);
    }
}