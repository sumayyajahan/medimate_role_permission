<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

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
       $admins = Admin::all();
       $roleSuperAdmin = Role::create(['guard_name'=>'admin','name' => 'Super Admin']);
       $roleAdmin = Role::create(['guard_name'=>'admin','name' => 'admin']);
       //$roleUser = Role::create(['guard_name'=>'admin','name' => 'user']);
       $roleAccount = Role::create(['guard_name'=>'admin','name' => 'account']);
       $roleDoctor = Role::create(['guard_name'=>'admin','name' => 'doctor']);
       $roleInsurance = Role::create(['guard_name'=>'admin','name' => 'inurance']);
       $rolePharmacies = Role::create(['guard_name'=>'admin','name' => 'pharmacy']);
       $roleInstitutionalClient = Role::create(['guard_name'=>'admin','name' => 'institutionalClient']);

       //Permission List as array
       $permissions = [
           'create ambulances',
           'edit ambulances',
           'delete ambulances',
           'view ambulances',
           'create admins',
           'edit admins',
           'delete admins',
           'view admins',
           'create appointment_schedules',
           'edit appointment_schedules',
           'delete appointment_schedules',
           'view appointment_schedules',
           'create appointment_slots',
           'edit appointment_slots',
           'delete appointment_slots',
           'view appointment_slots',
           'create bkash_recharge_requests',
           'edit bkash_recharge_requests',
           'delete bkash_recharge_requests',
           'view bkash_recharge_requests',
           'create bonus_points',
           'edit bonus_points',
           'delete bonus_points',
           'view bonus_points',
           'create bulk_reschedules',
           'edit bulk_reschedules',
           'delete bulk_reschedules',
           'view bulk_reschedules',
           'create cashouts',
           'edit cashouts',
           'delete cashouts',
           'view cashouts',
           'create claim_insurances',
           'edit claim_insurances',
           'delete claim_insurances',
           'view claim_insurances',
           'create common_settings',
           'edit common_settings',
           'delete common_settings',
           'view common_settings',
           'create contact_feedback',
           'edit contact_feedback',
           'delete contact_feedback',
           'view contact_feedback',
           'create diagnostics',
           'edit diagnostics',
           'delete diagnostics',
           'view diagnostics',
           'create districts',
           'edit districts',
           'delete districts',
           'view districts',
           'create divisions',
           'edit divisions',
           'delete divisions',
           'view divisions',
           'create doctors',
           'edit doctors',
           'delete doctors',
           'view doctors',
           'create doctor_specializations',
           'edit doctor_specializations',
           'delete doctor_specializations',
           'view doctor_specializations',
           'create doctor_visit_charges',
           'edit doctor_visit_charges',
           'delete doctor_visit_charges',
           'view doctor_visit_charges',
           'create doctor_wallets',
           'edit doctor_wallets',
           'delete doctor_wallets',
           'view doctor_wallets',
           'create e_prescriptions',
           'edit e_prescriptions',
           'delete e_prescriptions',
           'view e_prescriptions',
           'create failed_jobs',
           'edit failed_jobs',
           'delete failed_jobs',
           'view failed_jobs',
           'create feedback',
           'edit feedback',
           'delete feedback',
           'view feedback',
           'create good_health_declarations',
           'edit good_health_declarations',
           'delete good_health_declarations',
           'view good_health_declarations',
           'create insurances',
           'edit insurances',
           'delete insurances',
           'view insurances',
           'create insurance_enrolls',
           'edit insurance_enrolls',
           'delete insurance_enrolls',
           'view insurance_enrolls',
           'create insurance_packages',
           'edit insurance_packages',
           'delete insurance_packages',
           'view insurance_packages',
           'create jobs',
           'edit jobs',
           'delete jobs',
           'view jobs',
           'create lab_tests',
           'edit lab_tests',
           'delete lab_tests',
           'view lab_tests',
           'create login_activities',
           'edit login_activities',
           'delete login_activities',
           'view login_activities',
           'create notifications',
           'edit notifications',
           'delete notifications',
           'view notifications',
           'create notification_for_alls',
           'edit notification_for_alls',
           'delete notification_for_alls',
           'view notification_for_alls',
           'create otc_products',
           'edit otc_products',
           'delete otc_products',
           'view otc_products',
           'create payments',
           'edit payments',
           'delete payments',
           'view payments',
           'create pets',
           'edit pets',
           'delete pets',
           'view pets',
           'create pharmacies',
           'edit pharmacies',
           'delete pharmacies',
           'view pharmacies',
           'create pharmacy_salesmen',
           'edit pharmacy_salesmen',
           'delete pharmacy_salesmen',
           'view pharmacy_salesmen',
           'create referral_histories',
           'edit referral_histories',
           'delete referral_histories',
           'view referral_histories',
           'create referral_points',
           'edit referral_points',
           'delete referral_points',
           'view referral_points',
           'create report_prescriptions',
           'edit report_prescriptions',
           'delete report_prescriptions',
           'view report_prescriptions',
           'create service_providers',
           'edit service_providers',
           'delete service_providers',
           'view service_providers',
           'create service_provider_comissions',
           'edit service_provider_comissions',
           'delete service_provider_comissions',
           'view service_provider_comissions',
           'create service_provider_comission_histories',
           'edit service_provider_comission_histories',
           'delete service_provider_comission_histories',
           'view service_provider_comission_histories',
           'create service_provider_wallets',
           'edit service_provider_wallets',
           'delete service_provider_wallets',
           'view service_provider_wallets',
           'create specializations',
           'edit specializations',
           'delete specializations',
           'view specializations',
           'create state_trackings',
           'edit state_trackings',
           'delete state_trackings',
           'view state_trackings',
           'create state_trakings',
           'edit state_trakings',
           'delete state_trakings',
           'view state_trakings',
           'create users',
           'edit users',
           'delete users',
           'view users',
           'create user_orders',
           'edit user_orders',
           'delete user_orders',
           'view user_orders',
           'create user_wallets',
           'edit user_wallets',
           'delete user_wallets',
           'view user_wallets',
           'create wallet_transaction_logs',
           'edit wallet_transaction_logs',
           'delete wallet_transaction_logs',
           'view wallet_transaction_logs',

       ];

       //Assign Permissions
       for($i=0; $i< count($permissions); $i++){

        $permission = Permission::create(['guard_name'=>'admin','name' => $permissions[$i]]);
      //   $roleAdmin->givePermissionTo($permission);
      //   $permission->assignRole($roleAdmin);
       }





       //$permission->assignRole($roleSuperAdmin);
       $roleSuperAdmin->syncPermissions($permissions);
       //admin
       foreach($admins as $admin){
         if($admin->role == "Super Admin"){
            $admin->assignRole($roleSuperAdmin);
         }
         else{
            $admin->assignRole($roleAdmin);
         }
       }


    }
}
