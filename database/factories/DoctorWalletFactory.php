<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DoctorWallet;
use Faker\Generator as Faker;

$factory->define(DoctorWallet::class, function (Faker $faker) {

    static $doctorIntervals = 0;
    return [
        'doctor_id' => ++$doctorIntervals,
        'balance' => 0,
    ];
});
