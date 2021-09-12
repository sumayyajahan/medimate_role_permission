<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\ReferralPoint;
use Faker\Generator as Faker;

$factory->define(ReferralPoint::class, function (Faker $faker) {
    return [
        'user_refer_to' => 5,
        'user_refer_by' => 5,
        'doctor_refer_to' => 5,
        'doctor_refer_by' => 5,
        'service_refer_to' => 5,
        'service_refer_by' => 5,
    ];
});
