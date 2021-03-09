<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $role = Role::create(['name' => 'administrator']);
        $role1 = Role::create(['name' => 'teacher']);
        $role2 = Role::create(['name' => 'student']);

    }
}
