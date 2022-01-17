<?php

namespace Tests\Feature\Countries;

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

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::COUNTRIES_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_list_countries(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::COUNTRIES_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_countries(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::COUNTRIES_ROUTE_NAME));
        $response->assertViewHas('collection');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['collection']);
    }

    public function test_collection_has_countries(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::COUNTRIES_ROUTE_NAME));

        $this->assertInstanceOf(Country::class, $response->getOriginalContent()['collection']->first());
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
        $response = $this->actingAs($this->defaultUser())->get(route(self::COUNTRIES_ROUTE_NAME, $filters));
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
        $response = $this->actingAs($this->defaultUser())->get(route(self::COUNTRIES_ROUTE_NAME, $filters));

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
