<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CurrencySeeder::class,
            CountrySeeder::class,
            DocumentTypeSeeder::class,
            PaymentMethodSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
