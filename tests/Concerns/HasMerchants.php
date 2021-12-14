<?php

namespace Tests\Concerns;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;

trait HasMerchants
{
    private function createMerchants(): void
    {
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->count(3)
            ->create();
    }

    private function createMerchantsWithData(): void
    {
        $this->createMerchants();

        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->create([
                'name'     => 'EVERTEC',
                'brand'    => 'PlaceToPay',
                'document' => '1234567890',
                'url'      => 'https://placetopay.com',
            ]);
    }
}
