<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ServiceProvider;
use Faker\Generator as Faker;

$factory->define(ServiceProvider::class, function (Faker $faker) {
    return [
        'name' => 'lkajsdf',
        'email' => 'lkajsdf@dlf.com',
        'serviceid' => 'lkajsdf',
        'mobile' => '01833996321',
        'address' => 'lkajsdf'
    ];
});
