<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->enabled()->make([
            'name' => 'admin',
            'email' => 'admin@email.com',
        ]);
    }
}
