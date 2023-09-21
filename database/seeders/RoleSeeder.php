<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super-Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Governor']);
        Role::create(['name' => 'IT']);
        Role::create(['name' => 'Developer']);
        Role::create(['name' => 'Supervisor']);
        Role::create(['name' => 'Team Leader']);
        Role::create(['name' => 'Operator']);
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Guest']);
    }
}
