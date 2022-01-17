<?php

namespace Tests\Feature\Currencies;

use App\Constants\PermissionType;
use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public const CURRENCIES_ROUTE_NAME = 'currencies.index';
    public const CURRENCY_PERMISSION = PermissionType::CURRENCY_INDEX;

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::CURRENCIES_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $this->actingAs($this->defaultUser())
            ->get(route(self::CURRENCIES_ROUTE_NAME))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_list_currencies(): void
    {
        $this->actingAs($this->allowedUser(self::CURRENCY_PERMISSION))
            ->get(route(self::CURRENCIES_ROUTE_NAME))
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_currencies(): void
    {
        $response = $this->actingAs($this->allowedUser(self::CURRENCY_PERMISSION))
            ->get(route(self::CURRENCIES_ROUTE_NAME));

        $response->assertViewHas('collection');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['collection']);
    }

    public function test_collection_has_currencies(): void
    {
        $response = $this->actingAs($this->allowedUser(self::CURRENCY_PERMISSION))
            ->get(route(self::CURRENCIES_ROUTE_NAME));

        $this->assertInstanceOf(Currency::class, $response->getOriginalContent()['collection']->first());
    }

    public function test_it_can_filter_currencies(): void
    {
        $currencyName = 'Peso colombiano';

        Currency::factory()->count(3)->create();
        Currency::factory()->create(
            [
                'name' => $currencyName,
            ]
        );

        $filters = http_build_query(['filters' => ['name' => $currencyName]]);
        $response = $this->actingAs($this->allowedUser(self::CURRENCY_PERMISSION))
            ->get(route(self::CURRENCIES_ROUTE_NAME, $filters));

        $currencies = $response->getOriginalContent()['collection'];

        $this->assertEquals(1, $currencies->count());
        $this->assertEquals($currencyName, $currencies->first()->name);
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->allowedUser(self::CURRENCY_PERMISSION))
            ->get(route(self::CURRENCIES_ROUTE_NAME, $filters));

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    public function validationProvider(): array
    {
        return [
            'name min' => ['attribute' => 'name', 'value' => 'f'],
            'name max' => ['attribute' => 'name', 'value' => Str::random(126)],
        ];
    }
}
