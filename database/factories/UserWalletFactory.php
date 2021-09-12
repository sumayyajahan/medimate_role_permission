<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserWallet;
use Faker\Generator as Faker;

$factory->define(UserWallet::class, function (Faker $faker) {

    static $userIntervals = 0;
    $email = ["a@a.com", "b@b.com", "c@c.com"];
    return [
        'user_id' => ++$userIntervals,
        'balance' => 0,
    ];
});
