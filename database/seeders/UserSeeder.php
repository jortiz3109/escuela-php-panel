<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->enabled()->create(['name' => 'admin', 'email' => 'admin@email.com']);
    }
}
