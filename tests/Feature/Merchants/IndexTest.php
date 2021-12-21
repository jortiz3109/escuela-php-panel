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
        Merchant::factory()->create();

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

        $response->assertSee($merchant->name);
        $response->assertSee($merchant->brand);
        $response->assertSee($merchant->document);
        $response->assertSee($merchant->url);
        $response->assertSee($merchant->country->name);
        $response->assertSee($merchant->currency->alphabetic_code);
    }

    /**
     * @param array $data
     * @dataProvider filtersProvider
     */
    public function test_it_can_filter_merchants(array $data): void
    {
        $this->createMerchantsWithData();

        $filters = http_build_query(['filters' => ['merchant_query' => $data['filterValue']]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($data['filterValue'], $merchants->first()->attributesToArray()[$data['attribute']]);
    }

    public function test_it_can_filter_merchants_by_country(): void
    {
        $this->createMerchants();

        $country = Country::create([
            'name' => 'My country',
            'alpha_two_code' => 'ZZ',
            'alpha_three_code' => 'ZZZ',
            'numeric_code' => '000',
        ]);

        $merchant = Merchant::factory()
            ->for($country)
            ->create();

        $filters = http_build_query(['filters' => ['country' => 'ZZ']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($country->name, $merchants->first()->country);
        $this->assertEquals($merchant->country->name, $merchants->first()->country);
    }

    public function test_it_can_filter_merchants_by_currency(): void
    {
        $this->createMerchants();

        $currency = Currency::create([
            'name' => 'Fake currency',
            'minor_unit' => 0,
            'alphabetic_code' => 'FCY',
            'numeric_code' => '123',
            'symbol' => '$',
        ]);

        $merchant = Merchant::factory()
            ->for($currency)
            ->create();

        $filters = http_build_query(['filters' => ['currency' => 'FCY']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($merchant->currency->alphabetic_code, $merchants->first()->currency);
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    public function filtersProvider(): array
    {
        return [
            ['data' => ['attribute' => 'name', 'filterValue' => 'EVERTEC']],
            ['data' => ['attribute' => 'brand', 'filterValue' => 'PlaceToPay']],
            ['data' => ['attribute' => 'document', 'filterValue' => '1234567890']],
        ];
    }

    public function validationProvider(): array
    {
        return [
            'merchant_query min' => ['attribute' => 'merchant_query', 'value' => 'a'],
            'merchant_query max' => ['attribute' => 'merchant_query', 'value' => Str::random(121)],
        ];
    }

    private function createMerchants(): void
    {
        Merchant::factory()
            ->count(3)
            ->create();
    }

    private function createMerchantsWithData(): void
    {
        $this->createMerchants();

        Merchant::factory()
            ->create([
                'name'     => 'EVERTEC',
                'brand'    => 'PlaceToPay',
                'document' => '1234567890',
                'url'      => 'https://placetopay.com',
            ]);
    }
}
