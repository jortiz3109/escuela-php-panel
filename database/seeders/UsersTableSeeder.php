<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        if (config('app.env') !== 'production') {
            User::factory()->enabled()->create(['name' => 'admin', 'email' => 'admin@email.com']);
        }
    }
}
