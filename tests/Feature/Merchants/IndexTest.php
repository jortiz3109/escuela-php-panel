<?php

namespace Tests\Feature\Merchants;

use App\Constants\PermissionType;
use App\Models\Country;
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

    private const MERCHANT_PERMISSION = PermissionType::MERCHANT_INDEX;

    public function test_a_guest_user_cannot_access(): void
    {
        $this->get(Merchant::urlPresenter()->index())
            ->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $this->actingAs($this->defaultUser())
            ->get(Merchant::urlPresenter()->index())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_list_merchants(): void
    {
        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->index())
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_merchants(): void
    {
        $response = $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->index());

        $response->assertViewHas('collection');
        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $response->getOriginalContent()['collection']
        );
    }

    public function test_collection_has_merchants(): void
    {
        $this->createMerchantWithData();

        $response = $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->index());

        $this->assertInstanceOf(
            Merchant::class,
            $response->getOriginalContent()['collection']->first()
        );
    }

    public function test_it_show_merchants_data(): void
    {
        $merchant = $this->createMerchantWithData();

        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->index())
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
        Merchant::factory()
            ->for(Country::firstWhere('name', 'Brazil'))
            ->count(10)
            ->create();

        $this->createMerchantWithData();

        $filters = http_build_query(['filters' => [$filter => $filterValue]]);
        $response = $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->index($filters));

        $merchants = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $merchants);
        $response->assertSee($showedValue);
    }

    /**
     * @dataProvider filterValidationProvider
     */
    public function test_it_validates_filters(string $attribute, string $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->index($filters))
            ->assertSessionHasErrors("filters.{$attribute}");
    }
}
