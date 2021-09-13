<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@admin.com')->first();
        if(is_null($user)){
            $user = new User();
            $user->name = "admin";
            $user->email = "admin@admin.com";
            $user->userid = "10101020";
            $user->password = Hash::make('12345678');
            $user->save();
        }



        factory(User::class, 3)->create();
        // factory(User::class,3)->create();
    }
}
