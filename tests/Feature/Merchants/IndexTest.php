<?php

namespace Tests\Feature\Merchants;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
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

    /**
     * @param array $data
     * @dataProvider merchantProvider
     */
    public function test_it_show_merchants_data(array $data): void
    {
        $country = Country::factory()->create();
        $currency = Currency::factory()->create();

        $merchant = Merchant::factory()
            ->for($country)
            ->for($currency)
            ->create($data);

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
     * @dataProvider merchantProvider
     */
    public function test_it_can_filter_merchants_by_name(array $data): void
    {
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->count(3)
            ->create();

        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->create($data);

        $filters = http_build_query(['filters' => ['name' => 'EVERTEC']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($data['name'], $merchants->first()->name);
    }

    /**
     * @param array $data
     * @dataProvider merchantProvider
     */
    public function test_it_can_filter_merchants_by_brand(array $data): void
    {
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->count(3)
            ->create();

        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->create($data);

        $filters = http_build_query(['filters' => ['brand' => 'PlaceToPay']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($data['brand'], $merchants->first()->brand);
    }

    /**
     * @param array $data
     * @dataProvider merchantProvider
     */
    public function test_it_can_filter_merchants_by_document(array $data): void
    {
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->count(3)
            ->create();

        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->create($data);

        $filters = http_build_query(['filters' => ['document' => '1234567890']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($data['document'], $merchants->first()->document);
    }

    /**
     * @param array $data
     * @dataProvider merchantProvider
     */
    public function test_it_can_filter_merchants_by_url(array $data): void
    {
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->count(3)
            ->create();

        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->create($data);

        $filters = http_build_query(['filters' => ['url' => 'https://placetopay.com',]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($data['url'], $merchants->first()->url);
    }

    /**
     * @param array $data
     * @dataProvider countryProvider
     */
    public function test_it_can_filter_merchants_by_country(array $data): void
    {
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->count(3)
            ->create();

        Merchant::factory()
            ->for(Country::factory($data))
            ->for(Currency::factory())
            ->create();

        $filters = http_build_query(['filters' => ['country' => 'Colombia',]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($data['name'], $merchants->first()->country);
    }

    /**
     * @param array $data
     * @dataProvider currencyProvider
     */
    public function test_it_can_filter_merchants_by_currency(array $data): void
    {
        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory())
            ->count(3)
            ->create();

        Merchant::factory()
            ->for(Country::factory())
            ->for(Currency::factory($data))
            ->create();

        $filters = http_build_query(['filters' => ['currency' => 'COP',]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertEquals(1, $merchants->count());
        $this->assertEquals($data['alphabetic_code'], $merchants->first()->currency);
    }

    public function merchantProvider(): array
    {
        return [
            [
                'data' => [
                    'name'     => 'EVERTEC',
                    'brand'    => 'PlaceToPay',
                    'document' => '1234567890',
                    'url'      => 'https://placetopay.com',
                ],
            ],
        ];
    }

    public function countryProvider(): array
    {
        return [
            ['data' => ['name' => 'Colombia']],
        ];
    }

    public function currencyProvider(): array
    {
        return [
            ['data' => ['alphabetic_code' => 'COP']],
        ];
    }
}
