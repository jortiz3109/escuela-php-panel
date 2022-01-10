<?php

namespace Tests\Concerns;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use Illuminate\Support\Str;

trait MerchantHasDataProvider
{
    public function createMerchantWithData(array $attributes = []): Merchant
    {
        return Merchant::factory()
            ->for(Country::factory(['name' => 'countryName', 'alpha_two_code' => '12']))
            ->for(Currency::factory(['alphabetic_code' => '123']))
            ->create([
                'name' => 'EVERTEC',
                'brand' => 'PlacetoPay',
                'document' => '1234567890',
                'url' => 'https://placetopay.com',
            ]);
    }

    public function fakeMerchantData(array $attributes = []): array
    {
        $data = Merchant::factory()->make($attributes)->toArray();
        unset($data['uuid']);

        return $data;
    }

    public function filtersProvider(): array
    {
        return [
            'By name' => [
                'filter' => 'merchant_query',
                'attribute' => 'name',
                'filterValue' => 'EVERTEC',
                'showedValue' => 'EVERTEC',
            ],
            'By brand' => [
                'filter' => 'merchant_query',
                'attribute' => 'brand',
                'filterValue' => 'PlacetoPay',
                'showedValue' => 'PlacetoPay',
            ],
            'By document' => [
                'filter' => 'merchant_query',
                'attribute' => 'document',
                'filterValue' => '1234567890',
                'showedValue' => '1234567890',
            ],
            'By country' => [
                'filter' => 'country',
                'attribute' => 'country',
                'filterValue' => '12',
                'showedValue' => 'countryName',
            ],
            'By currency' => [
                'filter' => 'currency',
                'attribute' => 'currency',
                'filterValue' => '123',
                'showedValue' => '123',
            ],
        ];
    }

    public function filterValidationProvider(): array
    {
        return [
            'multiple min' => [
                'attribute' => 'merchant_query',
                'value' => 'a',
            ],
            'multiple max' => [
                'attribute' => 'merchant_query',
                'value' => Str::random(121),
            ],
        ];
    }
}
