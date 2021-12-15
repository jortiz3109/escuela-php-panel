<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'name' => 'Colombian Pesos',
                'minor_unit' => 2,
                'alphabetic_code' => 'COP',
                'numeric_code' => '170',
                'symbol' => '$',
            ],
            [
                'name' => 'US Dollar',
                'minor_unit' => 2,
                'alphabetic_code' => 'USD',
                'numeric_code' => '840',
                'symbol' => '$',
            ],
            [
                'name' => 'Brazilian Real',
                'minor_unit' => 2,
                'alphabetic_code' => 'BRL',
                'numeric_code' => '986',
                'symbol' => 'R$',
            ],
        ]);
    }
}
