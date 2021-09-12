<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StateTracking;
use Faker\Generator as Faker;

$factory->define(StateTracking::class, function (Faker $faker) {

    static $interval = -1;
    $name = ["Start", "Processing", "On The Way","Complete"];
    return [
        'name' => $name[++$interval]
    ];
});
