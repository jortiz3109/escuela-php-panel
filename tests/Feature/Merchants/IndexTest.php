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
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->create();

        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME));

        $this->assertInstanceOf(
            Merchant::class,
            $response->getOriginalContent()['merchants']->first()
        );
    }

    public function test_it_show_merchants_data(): void
    {
        $country = Country::factory()->create();
        $currency = Currency::factory()->create();

        $merchant = Merchant::factory()
            ->for($country)
            ->for($currency)
            ->create();

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

        $filters = http_build_query(['filters' => ['multiple' => $data['filterValue']]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($data['filterValue'], $merchants->first()->attributesToArray()[$data['attribute']]);
    }

    public function test_it_can_filter_merchants_by_country(): void
    {
        $this->createMerchants();

        $merchant = Merchant::factory()
            ->for(Country::factory(['alpha_two_code' => 'CO']))
            ->for(Currency::factory())
            ->create();

        $filters = http_build_query(['filters' => ['country' => 'CO']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($merchant->country->name, $merchants->first()->country);
    }

    public function test_it_can_filter_merchants_by_currency(): void
    {
        $this->createMerchants();

        $merchant = Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory(['alphabetic_code' => 'COP']))
            ->create();

        $filters = http_build_query(['filters' => ['multiple' => 'COP']]);
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
            ['data' => ['attribute' => 'url', 'filterValue' => 'https://placetopay.com']],
        ];
    }

    public function validationProvider(): array
    {
        return [
            'multiple min' => ['attribute' => 'multiple', 'value' => 'a'],
            'multiple max' => ['attribute' => 'multiple', 'value' => Str::random(256)],
        ];
    }

    private function createMerchants(): void
    {
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->count(3)
            ->create();
    }

    private function createMerchantsWithData(): void
    {
        $this->createMerchants();

        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->create([
                'name'     => 'EVERTEC',
                'brand'    => 'PlaceToPay',
                'document' => '1234567890',
                'url'      => 'https://placetopay.com',
            ]);
    }
}
