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
    public function run(): void
    {
       $roles = [
           ['role_name' => 'Admin', 'role_level' => 1],
           ['role_name' => 'User', 'role_level' => 2],
           ['role_name' => 'Guide', 'role_level' => 3],
       ];

        DB::table('roles')->insert($roles);
    }
}
