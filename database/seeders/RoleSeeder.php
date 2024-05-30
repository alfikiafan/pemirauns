<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            'superadmin',
            'admin_univ',
            'admin_fakultas',
        ];

        foreach ($roles as $role) {
            Role::updateOrInsert(['name' => $role]);
        }
    }
}