<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            DB::table('roles')->updateOrInsert(['name' => $role]);
        }
    }
}