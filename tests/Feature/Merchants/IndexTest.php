<?php

namespace Tests\Feature\Merchants;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use App\Models\User;
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
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_merchants(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route(self::MERCHANTS_ROUTE_NAME));
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

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route(self::MERCHANTS_ROUTE_NAME));

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

        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route(self::MERCHANTS_ROUTE_NAME));

        $response->assertSee($merchant->name);
        $response->assertSee($merchant->brand);
        $response->assertSee($merchant->document);
        $response->assertSee($merchant->url);
        $response->assertSee($merchant->country->name);
        $response->assertSee($merchant->currency->alphabetic_code);
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
                ]
            ],
        ];
    }
}
