<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        DB::table('countries')->insert([
            [
                'name' => 'Colombia',
                'alpha_two_code' => 'CO',
                'alpha_three_code' => 'COL',
                'numeric_code' => '170',
            ],
            [
                'name' => 'United States',
                'alpha_two_code' => 'US',
                'alpha_three_code' => 'USA',
                'numeric_code' => '840',
            ],
            [
                'name' => 'Brasil',
                'alpha_two_code' => 'BR',
                'alpha_three_code' => 'BRA',
                'numeric_code' => '076',
            ],
        ]);
    }
}
