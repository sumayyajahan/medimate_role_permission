<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Doctor;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    static $nameIntervals = -1;
    static $emailIntervals = -1;
    static $mobileInterval = 10;
    $name = ["doctor a", "doctor b", "doctor c"];
    $email = ["d@d.com", "e@e.com", "f@f.com"];
    return  [
        'name' => $name[++$nameIntervals],
        // 'details' => $faker->paragraph,
        'email' => $email[++$emailIntervals],
        'doctorid' => $faker->numberBetween(1, 2000000000),
        // 'phone' => $faker->numberBetween(1000000000, 2000000000),
        'address' => $faker->address,
        'mobile' => ++$mobileInterval,
        'image' => "15791434845e1fd13c9cf18.jpg",
        // 'author_status' => 1,
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // 12345678
        'remember_token' => Str::random(10),
    ];
});
