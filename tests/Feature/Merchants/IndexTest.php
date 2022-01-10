<?php

namespace Tests\Feature\Merchants;

use App\Constants\PermissionType;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\MerchantHasDataProvider;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantHasDataProvider;

    private const MERCHANTS_ROUTE_NAME = 'merchants.index';
    private const MERCHANT_PERMISSION = Merchant::PERMISSIONS[PermissionType::INDEX];

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_list_merchants(): void
    {
        $response = $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_merchants(): void
    {
        $response = $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))->get(route(self::MERCHANTS_ROUTE_NAME));

        $response->assertViewHas('merchants');
        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $response->getOriginalContent()['merchants']
        );
    }

    public function test_collection_has_merchants(): void
    {
        $this->createMerchantWithData();

        $response = $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))->get(route(self::MERCHANTS_ROUTE_NAME));

        $this->assertInstanceOf(
            Merchant::class,
            $response->getOriginalContent()['merchants']->first()
        );
    }

    public function test_it_show_merchants_data(): void
    {
        $merchant = $this->createMerchantWithData();

        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))->get(route(self::MERCHANTS_ROUTE_NAME))
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
        $response = $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))->get(route(self::MERCHANTS_ROUTE_NAME, $filters));
        $merchants = $response->getOriginalContent()['merchants'];

        $this->assertCount(1, $merchants);
        $response->assertSee($showedValue);
    }

    /**
     * @dataProvider filterValidationProvider
     */
    public function test_it_validates_filters(string $attribute, string $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))->get(route(self::MERCHANTS_ROUTE_NAME, $filters))
            ->assertSessionHasErrors("filters.{$attribute}");
    }
}
