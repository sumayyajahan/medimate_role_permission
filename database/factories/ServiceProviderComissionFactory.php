<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ServiceProviderComission;
use Faker\Generator as Faker;

$factory->define(ServiceProviderComission::class, function (Faker $faker) {
    static $typeIntervals = -1;
    static $amountIntervals = -1;
    $type = ["personal_recharge", "family_recharge", "patient_recharge"];
    $amount = [5, 10, 20];
    return  [
        'type' => $type[++$typeIntervals],
        'amount' => $amount[++$amountIntervals],
    ];
});
