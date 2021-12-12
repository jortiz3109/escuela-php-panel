<?php

namespace Tests\Unit\Filters\ModelFilters;

use App\Filters\Conditions\Countries\TwoCode as CountryTwoCode;
use App\Filters\Conditions\Currencies\AlphabeticCode as Currency;
use App\Filters\Conditions\Merchants\Multiple;
use App\Filters\ModelFilters\MerchantFilters;
use App\Models\Merchant;
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
            'multiple' => Multiple::class,
            'country' => CountryTwoCode::class,
            'currency' => Currency::class,
        ];

        $this->assertSame(
            $expected,
            $this->getReflectionProtectedPropertyValue(MerchantFilters::class, 'applicableConditions')
        );
    }
}
