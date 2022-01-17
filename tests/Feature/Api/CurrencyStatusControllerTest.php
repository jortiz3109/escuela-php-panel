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

    public function test_it_can_to_enable_a_currency(): void
    {
        $disabledCurrency = $this->disabledCurrency();

        $response = $this->actingAs($this->enabledUser())
            ->patch(route(self::TOGGLE_CURRENCY_STATUS_ROUTE, [$disabledCurrency->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => trans('common.responses.updated', ['model' => 'currency']),
            ]);

        $updatedCurrency = $disabledCurrency->fresh();

        $this->assertTrue($updatedCurrency->isEnabled());
    }

    public function test_it_can_to_disable_a_currency(): void
    {
        $enabledCurrency = $this->enabledCurrency();

        $response = $this->actingAs($this->enabledUser())
            ->patch(route(self::TOGGLE_CURRENCY_STATUS_ROUTE, [$enabledCurrency->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => trans('common.responses.updated', ['model' => 'currency']),
            ]);

        $updatedCurrency = $enabledCurrency->fresh();

        $this->assertTrue(!$updatedCurrency->isEnabled());
    }

    private function enabledCurrency(): Currency
    {
        if (!Currency::count()) {
            return Currency::factory()->enabled()->create();
        }

        $currency = Currency::first();
        $currency->markAsEnabled();
        return $currency;
    }

    private function disabledCurrency(): Currency
    {
        if (!Currency::count()) {
            return Currency::factory()->disabled()->create();
        }

        $currency = Currency::first();
        $currency->markAsDisabled();
        return $currency;
    }
}
