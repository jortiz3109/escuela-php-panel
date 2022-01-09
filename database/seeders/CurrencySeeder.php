<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = json_decode(file_get_contents(__DIR__ . '/../../resources/data_sources/currencies.json'), true);

        foreach ($currencies as $currency) {
            Currency::create([
                'name' => $currency['name'],
                'minor_unit' => $currency['fraction_digits'],
                'alphabetic_code' => $currency['currency_code'],
                'symbol' => $currency['symbol'],
                'enabled_at' => now(),
            ]);
        }
    }
}
