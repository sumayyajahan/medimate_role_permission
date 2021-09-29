<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
      static $nameIntervals = -1;
     static $emailIntervals = -1;
     static $roleIntervals = -1;
     static $adminIntervals = 0;
     $name = ["Admin One","Admin Two"];
     $email = ["admin@admin.com","admin2@admin.com"];
     $roles = ["Super Admin","admin"];
    return  [
            'name' => $name[++$nameIntervals],
            'email' => $email[++$emailIntervals],
            'mobile' => '01833996321',
            'admin_id'=> ++$adminIntervals,
            'password' => bcrypt(456456456),
            'role' => $roles[++$roleIntervals],
            'remember_token' => Str::random(10),

        ];
    // return [
    //     'name' => "Admin",
    //     'email' => "admin@admin.com",
    //     'mobile' => '01833996321',
    //     'password' => bcrypt(456456456),
    //     'remember_token' => Str::random(10),
    // ];
});
