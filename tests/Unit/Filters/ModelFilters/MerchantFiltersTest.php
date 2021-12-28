<?php

namespace Tests\Unit\Filters\ModelFilters;

use App\Models\Merchant;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MerchantFiltersTest extends TestCase
{
    public function test_query_without_params(): void
    {
        $expected = DB::table('merchants')
            ->select(
                'merchants.id',
                'merchants.name',
                'merchants.brand',
                'merchants.document',
                'merchants.url',
                'countries.name as country',
                'currencies.alphabetic_code as currency',
            )
            ->join('countries', 'merchants.country_id', '=', 'countries.id')
            ->join('currencies', 'merchants.currency_id', '=', 'currencies.id')
            ->toSql();

        $this->assertEquals($expected, Merchant::filter([])->toSql());
    }

    public function test_query_with_params(): void
    {
        $expected = DB::table('merchants')
            ->select(
                'merchants.id',
                'merchants.name',
                'merchants.brand',
                'merchants.document',
                'merchants.url',
                'countries.name as country',
                'currencies.alphabetic_code as currency',
            )
            ->join('countries', 'merchants.country_id', '=', 'countries.id')
            ->join('currencies', 'merchants.currency_id', '=', 'currencies.id')
            ->where(function ($query) {
                $query->where('merchants.name', 'like', '%AA%')
                    ->orWhere('merchants.brand', 'like', '%AA%')
                    ->orWhere('merchants.document', 'like', '%AA%');
            })
            ->where('countries.alpha_two_code', '12')
            ->where('currencies.alphabetic_code', '123')
            ->toSql();

        $this->assertEquals($expected, Merchant::filter($this->filterParams())->toSql());
    }

    private function filterParams(): array
    {
        return [
            'merchant_query' => 'AA',
            'country' => '12',
            'currency' => '123',
        ];
    }
}
