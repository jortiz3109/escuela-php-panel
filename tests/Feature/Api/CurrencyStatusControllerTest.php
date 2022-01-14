<?php

namespace Tests\Feature\Api;

use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class CurrencyStatusControllerTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    private const TOGGLE_CURRENCY_STATUS_ROUTE = 'currencies.status.toggle';

    /**
     * @dataProvider dataProvider
     */
    public function test_it_can_toggle_status(bool $status): void
    {
        $currency = $this->defaultCurrency($status);

        $this->actingAs($this->enabledUser())
            ->patch(route(self::TOGGLE_CURRENCY_STATUS_ROUTE, [$currency->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => trans('common.responses.updated', ['model' => 'currency']),
            ]);

        $currency->fresh();

        $this->assertTrue($status ? $currency->isEnabled() : !$currency->isEnabled());
    }

    public function dataProvider(): array
    {
        return [
            'change country enabled to disabled' => [true],
            'change country disabled to enabled' => [false],
        ];
    }

    private function defaultCurrency(bool $status): Currency
    {
        if (!Currency::count()) {
            return Currency::factory()->create(['enabled_at' => $status ? now() : null]);
        }

        $currency = Currency::first();
        $status ? $currency->markAsEnabled() : $currency->markAsDisabled();
        return $currency;
    }
}
