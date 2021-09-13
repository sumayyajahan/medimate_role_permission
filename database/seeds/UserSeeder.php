<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::
        if(is_null($user))){
            $user = new User();
            $user->name = "admin";
            $user->email = "admin@admin";
            $user->password = "12345678";
            $user->save();
        }



        factory(User::class, 30)->create();
        // factory(User::class,3)->create();
    }
}
