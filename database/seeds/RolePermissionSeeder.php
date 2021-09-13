<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //Create Roles
       $roleAdmin = Role::create(['name' => 'admin']);
       $roleSuperAdmin = Role::create(['name' => 'superadmin']);
       $roleUser = Role::create(['name' => 'user']);
       $roleEditor = Role::create(['name' => 'editor']);

       //Permission List as array
       $permissions = [
           'blogs.create',
           'contact.create',
       ];

       //Assign Permissions
       for($i=0; $i< count($permissions); $i++){

        $permission = Permission::create(['name' => $permissions[$i]]);
        $roleAdmin->givePermissionTo($permission);
        $permission->assignRole($roleAdmin);

       }
    }
}
