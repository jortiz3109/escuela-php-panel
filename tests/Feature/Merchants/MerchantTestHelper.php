<?php

namespace Tests\Feature\Merchants;

use App\Models\Merchant;

trait MerchantTestHelper
{
    public function fakeMerchant(array $attributes = []): Merchant
    {
        return Merchant::factory()->create($attributes);
    }

    public function fakeMerchantData(array $attributes = []): array
    {
        $fakeMerchantData = Merchant::factory()->make($attributes)->toArray();

        unset($fakeMerchantData['uuid']);

        return $fakeMerchantData;
    }
}
