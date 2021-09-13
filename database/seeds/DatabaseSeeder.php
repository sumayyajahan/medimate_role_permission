<?php

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\DoctorWallet;
use App\Models\InsuranceEnroll;
use App\Models\Job;
use App\Models\Pharmacy;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderComission;
use App\Models\ServiceProviderWallet;
use App\Models\StateTracking;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\UserWallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        factory(User::class, 3)->create();
        factory(Doctor::class, 3)->create();
        factory(ServiceProvider::class, 1)->create();
        factory(ServiceProviderWallet::class, 1)->create();
        // factory(UserOrder::class, 3)->create();
        factory(UserWallet::class, 3)->create();
        factory(DoctorWallet::class, 3)->create();
        // factory(ServiceProviderComission::class, 3)->create();
        // factory(InsurancePackage::class, 3)->create();
        // factory(InsuranceEnroll::class, 3)->create();
        // $this->call(ProgramSeeder::class);
        // $this->call(BlogSeeder::class);
        // factory(Team::class, 20)->create();
        // factory(Testimonial::class, 20)->create();
        // factory(Job::class, 20)->create();
        // factory(Branch::class, 20)->create();
        $this->call(UserSeeder::class);
        // $this->call(ContactFeedbackSeeder::class);
    }
}
