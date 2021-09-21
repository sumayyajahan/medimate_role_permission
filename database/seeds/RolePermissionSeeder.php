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
       $roleUser = Role::create(['name' => 'user']);
       $roleAccount = Role::create(['name' => 'account']);
       $roleDoctor = Role::create(['name' => 'doctor']);
       $roleInsurance = Role::create(['name' => 'inurance']);
       $roleInstitutionalClient = Role::create(['name' => 'institutionalClient']);

       //Permission List as array
       $permissions = [
           'create ambulances',
           'edit ambulances',
           'delete ambulances',
           'view ambulances',
       ];

       //Assign Permissions
       for($i=0; $i< count($permissions); $i++){

        $permission = Permission::create(['name' => $permissions[$i]]);
        $roleAdmin->givePermissionTo($permission);
        $permission->assignRole($roleAdmin);

       }
    }
}
