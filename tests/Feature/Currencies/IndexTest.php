<?php

namespace Tests\Feature\Currencies;

use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public const CURRENCIES_ROUTE_NAME = 'currencies.index';

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::CURRENCIES_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_list_currencies(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::CURRENCIES_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_currencies(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::CURRENCIES_ROUTE_NAME));
        $response->assertViewHas('currencies');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['currencies']);
    }

    public function test_collection_has_currencies(): void
    {
        Currency::factory()->create();
        $response = $this->actingAs($this->defaultUser())->get(route(self::CURRENCIES_ROUTE_NAME));
        $this->assertInstanceOf(Currency::class, $response->getOriginalContent()['currencies']->first());
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
        $response = $this->actingAs($this->defaultUser())->get(route(self::CURRENCIES_ROUTE_NAME, $filters));
        $currencies = $response->getOriginalContent()['currencies'];

        $this->assertEquals(1, $currencies->count());
        $this->assertEquals($currencyName, $currencies->first()->name);
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::CURRENCIES_ROUTE_NAME, $filters));

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
