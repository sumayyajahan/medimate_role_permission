<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        // $role = Role::first();
        // $permission = Permission::where('id',1);
        // //dd($role);
        // dd($role->permissions->pluck('name'));
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensCan([
            'doctor' => 'Access Doctor App',
            'pharmacy' => 'Access Pharmacy App',
            'pharmacySalesman' => 'Access Pharmacy Salesman App',
        ]);

        Passport::setDefaultScope([
            'doctor',
        ]);
        //

         // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
