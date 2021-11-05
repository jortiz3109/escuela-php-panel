<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Brand;
use App\Filters\Conditions\Country;
use App\Filters\Conditions\Document;
use App\Filters\Conditions\Merchant\Name;
use App\Filters\Conditions\Url;
use App\Filters\Filter;
use App\Models\Merchant;

class MerchantFilters extends Filter
{
    protected string $model = Merchant::class;

    protected array $applicableConditions = [
        'name'     => Name::class,
        'brand'    => Brand::class,
        'document' => Document::class,
        'url'      => Url::class,
        'country'  => Country::class,
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
