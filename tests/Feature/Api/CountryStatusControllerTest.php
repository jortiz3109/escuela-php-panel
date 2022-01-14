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

    /**
     * @dataProvider dataProvider
     */
    public function test_it_can_toggle_status(bool $status): void
    {
        $country = $this->defaultCountry($status);

        $this->actingAs($this->enabledUser())
            ->patch(route(self::TOGGLE_COUNTRY_STATUS_ROUTE, [$country->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => trans('common.responses.updated', ['model' => 'country']),
            ]);

        $country->fresh();

        $this->assertTrue($status ? $country->isEnabled() : !$country->isEnabled());
    }

    public function dataProvider(): array
    {
        return [
            'change country enabled to disabled' => [true],
            'change country disabled to enabled' => [false],
        ];
    }

    private function defaultCountry(bool $status): Country
    {
        if (!Country::count()) {
            return Country::factory()->create(['enabled_at' => $status ? now() : null]);
        }

        $country = Country::first();
        $status ? $country->markAsEnabled() : $country->markAsDisabled();
        return $country;
    }
}
