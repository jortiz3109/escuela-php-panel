<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use App\Models\Permission;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    private array $countries = [
        [
            'name' => 'Afghanistan',
            'alpha_two_code' => 'AF',
            'alpha_three_code' => 'AFG',
            'numeric_code' =>'004',
        ],
        [
            'name' => 'Brazil',
            'alpha_two_code' => 'BR',
            'alpha_three_code' => 'BRA',
            'numeric_code' => '076',
        ],
        [
            'name' => 'Colombia',
            'alpha_two_code' => 'CO',
            'alpha_three_code' => 'COL',
            'numeric_code' => '170',
        ],
        [
            'name' => 'Dominican Republic',
            'alpha_two_code' => 'DO',
            'alpha_three_code' => 'DOM',
            'numeric_code' => '214',
        ],
        [
            'name' => 'Ecuador',
            'alpha_two_code' => 'EC',
            'alpha_three_code' => 'ECU',
            'numeric_code' => '218',
        ],
        [
            'name' => 'France',
            'alpha_two_code' => 'FR',
            'alpha_three_code' => 'FRA',
            'numeric_code' => '250',
        ],
    ];

    private array $currencies = [
        [
            'name' => 'Afghan afghani',
            'alphabetic_code' => 'AFN',
            'numeric_code' => '971',
        ],
        [
            'name' => 'Brazilian real',
            'alphabetic_code' => 'BSD',
            'numeric_code' => '044',
        ],
        [
            'name' => 'Colombian peso',
            'alphabetic_code' => 'COP',
            'numeric_code' => '170',
        ],
        [
            'name' => 'Dominican peso',
            'alphabetic_code' => 'DOP',
            'numeric_code' => '214',
        ],
        [
            'name' => 'United States dollar',
            'alphabetic_code' => 'USD',
            'numeric_code' => '840',
        ],
        [
            'name' => 'Euro',
            'alphabetic_code' => 'EUR',
            'numeric_code' => '978',
        ],
    ];

    public function run(): void
    {
        User::factory()->enabled()->create([
            'email' => 'admin@example.com',
        ]);

        User::factory()->disabled()->create([
            'email' => 'disabled@example.com',
        ]);

        Permission::factory(100)->create();

        $countries = new Collection();
        for ($i=0; $i < 6; $i++) { 
            $countryData = array_pop($this->countries);

            $country = Country::factory()->create([
                'name'             => $countryData['name'],
                'alpha_two_code'   => $countryData['alpha_two_code'],
                'alpha_three_code' => $countryData['alpha_three_code'],
                'numeric_code'     => $countryData['numeric_code'],
            ]);

            $countries->push($country);
        }

        $currencies = new Collection();
        for ($i=0; $i < 6; $i++) { 
            $currencyData = array_pop($this->currencies);

            $currency = Currency::factory()->create([
                'name'            => $currencyData['name'],
                'alphabetic_code' => $currencyData['alphabetic_code'],
                'numeric_code'    => $currencyData['numeric_code'],
            ]);

            $currencies->push($currency);
        }

        for ($i=1; $i <= 20; $i++) { 
            Merchant::factory()
                ->create([
                    'country_id' => $countries->random()->id,
                    'currency_id' => $countries->random()->id,
                ]);
        }

        $this->call(PaymentMethodSeeder::class);

        Merchant::first()->transactions()->save(
            Transaction::factory()->make()
        );
    }
}
