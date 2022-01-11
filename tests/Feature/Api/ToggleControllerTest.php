<?php

namespace Tests\Feature\Api;

use App\Constants\Toggle;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class ToggleControllerTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    /**
     * @dataProvider dataProvider
     */
    public function test_it_can_toggle_status(string $model, string $toggleable, bool $status): void
    {
        $resource = $model::factory()->create([
            'enabled_at' => $status ? now() : null,
        ]);

        $this->actingAs($this->enabledUser())->patch(route('toggle', [$toggleable, $resource->id]))
            ->assertStatus(Response::HTTP_OK);

        $resource->fresh();
        $this->assertTrue($status ? $resource->isEnabled() : !$resource->isEnabled());
    }

    public function dataProvider(): array
    {
        return [
            'change user enabled to disabled' => [User::class, Toggle::USER, true],
            'change user disabled to enabled' => [User::class, Toggle::USER, false],
            'change payment method enabled to disabled' => [PaymentMethod::class, Toggle::PAYMENT_METHOD, true],
            'change payment method disabled to enabled' => [PaymentMethod::class, Toggle::PAYMENT_METHOD, false],
        ];
    }
}
