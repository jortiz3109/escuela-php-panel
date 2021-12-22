<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Countries\TwoCode as CountryTwoCode;
use App\Filters\Conditions\Currencies\AlphabeticCode as Currency;
use App\Filters\Conditions\Merchants\MerchantQuery;
use App\Filters\Filter;
use App\Models\Merchant;

class MerchantFilters extends Filter
{
    protected string $model = Merchant::class;

    protected array $applicableConditions = [
        'merchantQuery' => MerchantQuery::class,
        'country' => CountryTwoCode::class,
        'currency' => Currency::class,
    ];

    protected function joins(): Filter
    {
        $this->query->join('countries', 'merchants.country_id', '=', 'countries.id');
        $this->query->join('currencies', 'merchants.currency_id', '=', 'currencies.id');

        return $this;
    }

    protected function select(): Filter
    {
        $this->query->select(
            'merchants.name',
            'merchants.brand',
            'merchants.document',
            'merchants.url',
            'countries.name as country',
            'currencies.alphabetic_code as currency',
        );

        return $this;
    }
}
