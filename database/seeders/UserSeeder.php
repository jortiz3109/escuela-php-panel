<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::create([
            'name' => env('NAME_USER'),
            'email' => env('EMAIL_USER'),
            'email_verified_at' => now(),
            'password' => Hash::make(env('PASSWORD_USER')),
            'remember_token' => Str::random(10),
            'enabled_at' => now(),
        ]);

        event(new Registered($user));
    }
}
