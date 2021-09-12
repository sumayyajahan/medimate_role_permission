<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ServiceProviderWallet;
use Faker\Generator as Faker;

$factory->define(ServiceProviderWallet::class, function (Faker $faker) {
    static $userIntervals = 0;
    return [
        'service_provider_id' => ++$userIntervals,
        'balance' => 0,
    ];
});
