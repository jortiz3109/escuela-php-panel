<?php

namespace Tests\Feature\Api;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class CountryStatusControllerTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    private const TOGGLE_COUNTRY_STATUS_ROUTE = 'countries.status.toggle';

    public function test_it_can_to_enable_a_country(): void
    {
        $disabledCountry = $this->disabledCountry();

        $response = $this->actingAs($this->enabledUser())
            ->patch(route(self::TOGGLE_COUNTRY_STATUS_ROUTE, [$disabledCountry->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => trans('common.responses.updated', ['model' => 'country']),
            ]);

        $updatedCountry = $disabledCountry->fresh();

        $this->assertTrue($updatedCountry->isEnabled());
    }

    public function test_it_can_to_disable_a_country(): void
    {
        $enabledCountry = $this->enabledCountry();

        $response = $this->actingAs($this->enabledUser())
            ->patch(route(self::TOGGLE_COUNTRY_STATUS_ROUTE, [$enabledCountry->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => trans('common.responses.updated', ['model' => 'country']),
            ]);

        $updatedCountry = $enabledCountry->fresh();

        $this->assertTrue(!$updatedCountry->isEnabled());
    }

    private function enabledCountry(): Country
    {
        if (!Country::count()) {
            return Country::factory()->enabled()->create();
        }

        $country = Country::first();
        $country->markAsEnabled();
        return $country;
    }

    private function disabledCountry(): Country
    {
        if (!Country::count()) {
            return Country::factory()->disabled()->create();
        }

        $country = Country::first();
        $country->markAsDisabled();
        return $country;
    }
}
