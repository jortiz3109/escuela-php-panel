<?php

namespace Tests\Feature\Api;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class PaymentMethodControllerTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    /**
     * @dataProvider dataProvider
     */
    public function test_it_can_toggle_status(bool $status): void
    {
        $paymentMethod = PaymentMethod::factory()->create([
            'enabled_at' => $status ? now() : null,
        ]);

        $this->actingAs($this->enabledUser())
            ->patch(route('payment-methods.status.toggle', [$paymentMethod->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => trans('common.responses.updated', ['model' => 'payment method']),
            ]);

        $paymentMethod->fresh();

        $this->assertTrue($status ? $paymentMethod->isEnabled() : !$paymentMethod->isEnabled());
    }

    public function dataProvider(): array
    {
        return [
            'change payment method enabled to disabled' => [true],
            'change payment method disabled to enabled' => [false],
        ];
    }
}
