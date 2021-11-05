<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Filter;
use App\Models\Merchant;

class MerchantFilters extends Filter
{
    protected string $model = Merchant::class;

    protected array $applicableConditions = [
        'name' => Name::class,
    ];
}
