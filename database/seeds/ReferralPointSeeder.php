<?php

use App\Models\ReferralPoint;
use Illuminate\Database\Seeder;

class ReferralPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ReferralPoint::class,1)->create();
    }
}
