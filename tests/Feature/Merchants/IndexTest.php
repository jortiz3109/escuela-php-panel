<?php

namespace Tests\Feature\Merchants;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    private const MERCHANTS_ROUTE_NAME = 'merchants.index';

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_list_merchants(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_merchants(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME));

        $response->assertViewHas('merchants');
        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $response->getOriginalContent()['merchants']
        );
    }

    public function test_collection_has_merchants(): void
    {
        Merchant::factory()->count(3)->create();

        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME));

        $this->assertInstanceOf(
            Merchant::class,
            $response->getOriginalContent()['merchants']->first()
        );
    }

    public function test_it_show_merchants_data(): void
    {
        $merchant = Merchant::factory()->create();

        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME));
        $response
            ->assertSee($merchant->name)
            ->assertSee($merchant->brand)
            ->assertSee($merchant->document)
            ->assertSee($merchant->url)
            ->assertSee($merchant->country->name)
            ->assertSee($merchant->currency->alphabetic_code);
    }

    /**
     * @param string $filter
     * @param string $attribute
     * @param string $filterValue
     * @param string $showedValue
     * @dataProvider filtersProvider
     */
    public function test_it_can_filter_merchants(
        string $filter,
        string $attribute,
        string $filterValue,
        string $showedValue
    ): void {
        Merchant::factory()->count(10)->create();
        $this->createMerchantWithData();

        $filters = http_build_query(['filters' => [$filter => $filterValue]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($showedValue, $merchants->first()->attributesToArray()[$attribute]);
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, string $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    public function filtersProvider(): array
    {
        return [
            'By name' => [
                'filter' => 'multiple',
                'attribute' => 'name',
                'filterValue' => 'EVERTEC',
                'showedValue' => 'EVERTEC',
            ],
            'By brand' => [
                'filter' => 'multiple',
                'attribute' => 'brand',
                'filterValue' => 'PlacetoPay',
                'showedValue' => 'PlacetoPay',
            ],
            'By document' => [
                'filter' => 'multiple',
                'attribute' => 'document',
                'filterValue' => '1234567890',
                'showedValue' => '1234567890',
            ],
            'By country' => [
                'filter' => 'country',
                'attribute' => 'country',
                'filterValue' => '12',
                'showedValue' => 'countryName',
            ],
            'By currency' => [
                'filter' => 'currency',
                'attribute' => 'currency',
                'filterValue' => '123',
                'showedValue' => '123',
            ],
        ];
    }

    public function validationProvider(): array
    {
        return [
            'multiple min' => [
                'attribute' => 'multiple',
                'value' => 'a',
            ],
            'multiple max' => [
                'attribute' => 'multiple',
                'value' => Str::random(121),
            ],
        ];
    }

    private function createMerchantWithData(): Merchant
    {
        return Merchant::factory()
            ->for(Country::factory(['name' => 'countryName', 'alpha_two_code' => '12']))
            ->for(Currency::factory(['alphabetic_code' => '123']))
            ->create([
                'name' => 'EVERTEC',
                'brand' => 'PlacetoPay',
                'document' => '1234567890',
                'url' => 'https://placetopay.com',
            ]);
    }
}
