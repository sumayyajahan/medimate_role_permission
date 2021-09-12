<?php

use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = asset('/my_files/districts.sql');
        $sql = file_get_contents($path);
        \Illuminate\Support\Facades\DB::unprepared($sql);
    }
}
