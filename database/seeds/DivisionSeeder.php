<?php

use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = array(
            [
                'name' => 'Barishal',
                'bn_name' => 'বরিশাল',
                'lat' => '22.3811',
                'lon' => '90.3372',
            ],
            [
                'name' => 'Chattogram',
                'bn_name' => 'চট্টগ্রাম',
                'lat' => '23.1793',
                'lon' => '91.9882',
            ],
            [
                'name' => 'Dhaka',
                'bn_name' => 'ঢাকা',
                'lat' => '23.9536',
                'lon' => '90.1495',
            ],
            [
                'name' => 'Khulna',
                'bn_name' => 'খুলনা',
                'lat' => '22.8088',
                'lon' => '89.2467',
            ],
            [
                'name' => 'Mymensingh',
                'bn_name' => 'ময়মনসিংহ',
                'lat' => '24.7136',
                'lon' => '90.4502',
            ],
            [
                'name' => 'Rajshahi',
                'bn_name' => 'রাজশাহী',
                'lat' => '24.7106',
                'lon' => '88.9414',
            ],
            [
                'name' => 'Rangpur',
                'bn_name' => 'রংপুর',
                'lat' => '25.8483',
                'lon' => '88.9414',
            ],
            [
                'name' => 'Sylhet',
                'bn_name' => 'সিলেট',
                'lat' => '24.7050',
                'lon' => '91.6761',
            ],
        );

        foreach ($divisions as $division){
            \App\Models\Division::create($division);
        }

    }
}
