<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(
            [
                'name' => 'create user',
                'section' => 'user'
            ]
        );
        Permission::create(
            [
                'name' => 'edit user',
                'section' => 'user'
            ]
        );
        Permission::create(
            [
                'name' => 'delete user',
                'section' => 'user'
            ]
        );

        Permission::create(
            [
                'name' => 'edit attendances',
                'section' => 'attendance'
            ]
        );
        Permission::create(
            [
                'name' => 'delete attendances',
                'section' => 'attendance'
            ]
        );

        Permission::create(
            [
                'name' => 'create comunication',
                'section' => 'comunication'
            ]
        );
        Permission::create(
            [
                'name' => 'edit comunication',
                'section' => 'comunication'
            ]
        );
        Permission::create(
            [
                'name' => 'delete comunication',
                'section' => 'comunication'
            ]
        );

        Permission::create(
            [
                'name' => 'import roster',
                'section' => 'roster'
            ]
        );
        Permission::create(
            [
                'name' => 'edit roster',
                'section' => 'roster'
            ]
        );
        Permission::create(
            [
                'name' => 'see roster',
                'section' => 'roster'
            ]
        );

        Permission::create(
            [
                'name' => 'create permission',
                'section' => 'permission'
            ]
        );
        Permission::create(
            [
                'name' => 'delete permission',
                'section' => 'permission'
            ]
        );

        Permission::create(
            [
                'name' => 'create role',
                'section' => 'role'
            ]
        );
        Permission::create(
            [
                'name' => 'assign permission role',
                'section' => 'role'
            ]
        );
        Permission::create(
            [
                'name' => 'delete role',
                'section' => 'role'
            ]
        );

        Permission::create(
            [
                'name' => 'create question',
                'section' => 'question'
            ]
        );
        Permission::create(
            [
                'name' => 'edit question',
                'section' => 'question'
            ]
        );
        Permission::create(
            [
                'name' => 'delete question',
                'section' => 'question'
            ]
        );

        Permission::create(
            [
                'name' => 'create progen customer',
                'section' => 'progen customer'
            ]
        );
        Permission::create(
            [
                'name' => 'edit progen customer',
                'section' => 'progen customer'
            ]
        );
        Permission::create(
            [
                'name' => 'delete progen customer',
                'section' => 'progen customer'
            ]
        );

    }
}
