<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $user =User::create([
            "name"=>"Admin",
            "email"=>"jeante05@gmail.com",
            'email_verified_at' => now(),
            "password"=>Hash::make('jeante05'),
            'remember_token' => Str::random(10),
        ]);

        event(new Registered($user));

        Auth::login($user);


    }
}
