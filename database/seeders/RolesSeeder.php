<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name'=>'admin']);
        $default = Role::create(['name'=>'default']);

        $manage_users_permission = Permission::create(['name' => 'manage users']);
        $create_draft = Permission::create(['name' => 'create minuta']);

        $permissions = [
            $manage_users_permission,
            $create_draft
        ];

        $admin->syncPermissions($permissions);
        $default->syncPermissions([$create_draft]);
    }
}
