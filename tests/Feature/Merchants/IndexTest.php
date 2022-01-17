<?php

namespace Tests\Feature\Merchants;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
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
    use MerchantTestHelper;

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(Merchant::urlPresenter()->index());
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_list_merchants(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->index());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_merchants(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->index());

        $response->assertViewHas('collection');
        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $response->getOriginalContent()['collection']
        );
    }

    public function test_collection_has_merchants(): void
    {
        $this->fakeMerchant();

        $response = $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->index());

        $this->assertInstanceOf(
            Merchant::class,
            $response->getOriginalContent()['collection']->first()
        );
    }

    public function test_it_show_merchants_data(): void
    {
        $merchant = $this->fakeMerchant();

        $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->index())
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
        $merchants = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $merchants);
        $response->assertSee($showedValue);
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, string $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $filters))
            ->assertSessionHasErrors("filters.{$attribute}");
    }

    public function filtersProvider(): array
    {
        return [
            'By name' => [
                'filter' => 'merchant_query',
                'attribute' => 'name',
                'filterValue' => 'EVERTEC',
                'showedValue' => 'EVERTEC',
            ],
            'By brand' => [
                'filter' => 'merchant_query',
                'attribute' => 'brand',
                'filterValue' => 'PlacetoPay',
                'showedValue' => 'PlacetoPay',
            ],
            'By document' => [
                'filter' => 'merchant_query',
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
                'attribute' => 'merchant_query',
                'value' => 'a',
            ],
            'multiple max' => [
                'attribute' => 'merchant_query',
                'value' => Str::random(121),
            ],
        ];
    }

    private function createMerchantWithData(): Merchant
    {
        return Merchant::factory()
            ->for(
                Country::factory(
                    [
                        'name' => 'countryName',
                        'alpha_two_code' => '12',
                        'alpha_three_code' => '123',
                        'numeric_code' => '0',
                    ]
                )
            )
            ->for(Currency::factory(['alphabetic_code' => '123']))
            ->create([
                'name' => 'EVERTEC',
                'brand' => 'PlacetoPay',
                'document' => '1234567890',
                'url' => 'https://placetopay.com',
            ]);
    }
}
