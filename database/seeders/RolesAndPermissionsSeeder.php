<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);
        $edit_categories_permission = Permission::create(['name' => 'edit-categories']);
        $edit_products_permission = Permission::create(['name' => 'edit-products']);

        $edit_categories_permission->assignRole($role);
        $edit_products_permission->assignRole($role);
    }
}
