<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat roles
        $roles = [
            'superadmin',
            'admin_univ',
            'admin_fakultas',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Assign roles to users
        $adminUniv = User::factory()->count(10)->create();
        foreach ($adminUniv as $admin) {
            $role = Role::where('name', 'admin_univ')->first();
            UserRole::create([
                'user_id' => $admin->id,
                'role_id' => $role->id,
                'faculty' => 'Univ',
            ]);
        }

        $adminFakultas = User::factory()->count(20)->create();
        foreach ($adminFakultas as $admin) {
            $role = Role::where('name', 'admin_fakultas')->first();
            UserRole::create([
                'user_id' => $admin->id,
                'role_id' => $role->id,
                'faculty' => $admin->faculty,
            ]);
        }

        //Create user dummy
        $user = User::create([
            'name' => 'User',
            'email' => 'user@pemira.com',
            'nim' => 'L0001',
            'password' => bcrypt('user'),
            'faculty' => 'Univ',
            'batch' => 2020,
        ]);

        User::factory()->count(20)->create();
    }
}