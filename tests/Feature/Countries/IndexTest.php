<?php

namespace Tests\Feature\Countries;

use App\Constants\PermissionType;
use App\Http\Resources\Countries\CountryIndexResource;
use App\Models\Country;
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

    public const COUNTRIES_ROUTE_NAME = 'countries.index';
    private const COUNTRY_PERMISSION = PermissionType::COUNTRY_INDEX;

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::COUNTRIES_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::COUNTRIES_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_list_countries(): void
    {
        $response = $this->actingAs($this->allowedUser(self::COUNTRY_PERMISSION))->get(route(self::COUNTRIES_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_countries(): void
    {
        $response = $this->actingAs($this->allowedUser(self::COUNTRY_PERMISSION))->get(route(self::COUNTRIES_ROUTE_NAME));

        $response->assertViewHas('collection');
        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $response->getOriginalContent()['collection']->resource
        );
    }

    public function test_collection_has_countries(): void
    {
        $response = $this->actingAs($this->allowedUser(self::COUNTRY_PERMISSION))->get(route(self::COUNTRIES_ROUTE_NAME));

        $this->assertInstanceOf(CountryIndexResource::class, $response->getOriginalContent()['collection']->first());
    }

    public function test_it_can_filter_countries(): void
    {
        $countryName = 'Colombia';

        if (0 === Country::count()) {
            Country::factory()->count(3)->create();
            Country::factory()->create(
                [
                    'name' => $countryName,
                ]
            );
        }

        $filters = http_build_query(['filters' => ['name' => $countryName]]);
        $response = $this->actingAs($this->allowedUser(self::COUNTRY_PERMISSION))->get(route(self::COUNTRIES_ROUTE_NAME, $filters));
        $countries = $response->getOriginalContent()['collection'];

        $this->assertEquals(1, $countries->count());
        $this->assertEquals($countryName, $countries->first()->name);
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->allowedUser(self::COUNTRY_PERMISSION))->get(route(self::COUNTRIES_ROUTE_NAME, $filters));

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    public function validationProvider(): array
    {
        return [
            'name min' => ['attribute' => 'name', 'value' => 'f'],
            'name max' => ['attribute' => 'name', 'value' => Str::random(81)],
        ];
    }
}
