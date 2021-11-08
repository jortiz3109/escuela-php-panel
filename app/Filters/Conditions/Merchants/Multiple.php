<?php

namespace App\Filters\Conditions\Merchants;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class Multiple extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        Log::info("Pasó por aquí");
        
        $query->where('merchants.name', 'like', "%{$criteria}%")
            ->orWhere('merchants.brand', 'like', "%{$criteria}%")
            ->orWhere('merchants.document', 'like', "%{$criteria}%")
            ->orWhere('merchants.url', 'like', "%{$criteria}%")
            ->orWhere('countries.name', 'like', "%{$criteria}%")
            ->orWhere('currencies.alphabetic_code', 'like', "%{$criteria}%");
    }
}
