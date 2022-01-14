<?php

namespace Tests\Unit\Filters;

use App\Filters\Conditions\CreatedAt;
use App\Filters\Conditions\CurrencyAlphabeticCode;
use App\Filters\Conditions\Email;
use App\Filters\Conditions\Merchants\CountryTwoCode;
use App\Filters\Conditions\Name;
use App\Filters\Conditions\Status;
use App\Filters\Conditions\Transactions\DateBetween;
use App\Filters\Conditions\Transactions\MerchantName;
use App\Filters\Conditions\Transactions\PaymentMethodId;
use App\Filters\Conditions\Transactions\Reference;
use App\Filters\Conditions\Transactions\Status as TransactionStatus;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Tests\TestCase;

class ConditionsTest extends TestCase
{
    private Builder $builder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = app(Builder::class);
    }

    /**
     * @param string $class
     * @param string|array $criteria
     * @param string $expected
     * @dataProvider conditionsProvider
     */
    public function test_conditions(string $class, string|array $criteria, string $expected): void
    {
        $class::append($this->builder, new Criteria($criteria));
        //dd($this->builder->toSql());
        $this->assertEquals($expected, $this->builder->toSql());
    }

    public function conditionsProvider(): array
    {
        return [
            'merchants country two code' => [
                'condition class' => CountryTwoCode::class,
                'criteria' => Str::random(2),
                'expected sql' => 'select * where "countries"."alpha_two_code" = ?',
            ],
            'currency alphabetic code' => [
                'conditions class' => CurrencyAlphabeticCode::class,
                'criteria' => Str::random(3),
                'expected sql' => 'select * where "currencies"."alphabetic_code" = ?',
            ],
            'name' => [
                'conditions class' => Name::class,
                'criteria' => Str::random(10),
                'expected sql' => 'select * where "name" like ?',
            ],
            'transactions date between' => [
                'conditions class' => DateBetween::class,
                'criteria' => ['2022-01-01', '2022-01-02'],
                'expected sql' => 'select * where "date" between ? and ?',
            ],
            'transactions merchant name' => [
                'conditions class' => MerchantName::class,
                'criteria' => Str::random(10),
                'expected sql' => 'select * where "merchants"."name" like ?',
            ],
            'transactions payment method id' => [
                'conditions class' => PaymentMethodId::class,
                'criteria' => Str::random(1),
                'expected sql' => 'select * where "payment_methods"."id" = ?',
            ],
            'transactions reference' => [
                'conditions class' => Reference::class,
                'criteria' => Str::random(6),
                'expected sql' => 'select * where "reference" like ?',
            ],
            'transactions status' => [
                'conditions class' => TransactionStatus::class,
                'criteria' => Str::random(5),
                'expected sql' => 'select * where "status" = ?',
            ],
            'created at' => [
                'conditions class' => CreatedAt::class,
                'criteria' => Str::random(10),
                'expected sql' => 'select * where date("created_at") = ?',
            ],
            'email' => [
                'conditions class' => Email::class,
                'criteria' => Str::random(10),
                'expected sql' => 'select * where "email" like ?',
            ],
            'status' => [
                'conditions class' => Status::class,
                'criteria' => Str::random(5),
                'expected sql' => 'select *',
            ],
        ];
    }
}
