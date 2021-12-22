<?php

namespace Tests\Unit\Filters\ModelFilters;

use App\Filters\Conditions\Countries\TwoCode as CountryTwoCode;
use App\Filters\Conditions\Currencies\AlphabeticCode as Currency;
use App\Filters\Conditions\Merchants\MerchantQuery;
use App\Filters\ModelFilters\MerchantFilters;
use App\Models\Merchant;
use Illuminate\Support\Facades\DB;
use ReflectionException;
use Tests\TestCase;

class MerchantFiltersTest extends TestCase
{
    private string $modelInstance = Merchant::class;

    /**
     * @throws ReflectionException
     */
    public function test_model_instance(): void
    {
        $this->assertSame(
            $this->modelInstance,
            $this->getReflectionProtectedPropertyValue(MerchantFilters::class, 'model')
        );
    }

    /**
     * @throws ReflectionException
     */
    public function test_applicable_conditions(): void
    {
        $expected = [
            'merchantQuery' => MerchantQuery::class,
            'country' => CountryTwoCode::class,
            'currency' => Currency::class,
        ];

        $this->assertSame(
            $expected,
            $this->getReflectionProtectedPropertyValue(MerchantFilters::class, 'applicableConditions')
        );
    }

    public function test_query_without_params(): void
    {
        $expected = DB::table('merchants')
            ->select(
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
            'merchantQuery' => 'AA',
            'country' => '12',
            'currency' => '123',
        ];
    }
}
