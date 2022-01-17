<?php

namespace Tests\Feature\Transactions;

use App\Constants\PermissionType;
use App\Http\Resources\Transactions\TransactionShowResource;
use App\Models\Person;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class DetailsTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use WithFaker;

    public const TRANSACTION_DETAILS_ROUTE_NAME = 'transactions.show';
    private const TRANSACTION_PERMISSION = Transaction::PERMISSIONS[PermissionType::SHOW];

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, 1));
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($this->defaultUser())
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_render_the_transaction_details_page(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($this->allowedUser(self::TRANSACTION_PERMISSION))
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_transaction_model(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($this->allowedUser(self::TRANSACTION_PERMISSION))
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertViewHas('model');
        $this->assertEquals((new TransactionShowResource($transaction))->toArray(), $response->getOriginalContent()['model']);
    }

    public function test_it_can_show_the_transaction_info(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($this->allowedUser(self::TRANSACTION_PERMISSION))
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertSee($transaction->merchant->name)
            ->assertSee($transaction->reference)
            ->assertSee($transaction->paymentMethod->logo)
            ->assertSee($transaction->card_number)
            ->assertSee($transaction->currency->name)
            ->assertSee($transaction->currency->alphabetic_code)
            ->assertSee($transaction->currency->symbol)
            ->assertSee($transaction->status)
            ->assertSee($transaction->ip_address)
            ->assertSee(route('transactions.index'))
            ->assertSeeText(trans('transactions.fields.geolocation'));
    }

    public function test_it_show_the_payer_info(): void
    {
        $transaction = Transaction::factory()
            ->for(Person::factory()->create([
                'name' => 'payer-name',
                'email' => 'payer@example.com',
            ]), 'payer')
            ->create();

        $response = $this->actingAs($this->allowedUser(self::TRANSACTION_PERMISSION))
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertSee('payer-name');
        $response->assertSee('payer@example.com');
    }

    public function test_it_show_the_buyer_info(): void
    {
        $transaction = Transaction::factory()
            ->for(Person::factory()->create([
                'name' => 'buyer-name',
                'email' => 'buyer@example.com',
            ]), 'payer')
            ->create();

        $response = $this->actingAs($this->allowedUser(self::TRANSACTION_PERMISSION))
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertSee('buyer-name');
        $response->assertSee('buyer@example.com');
    }

    public function test_it_must_request_location_when_transaction_have_not_lat_lng(): void
    {
        $latitude = $this->faker->latitude();
        $longitude = $this->faker->longitude();
        Http::fake(function () use ($latitude, $longitude) {
            return [
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];
        });
        $transaction = Transaction::factory()->create([
            'latitude' => null,
            'longitude' => null,
        ]);

        $response = $this->actingAs($this->allowedUser(self::TRANSACTION_PERMISSION))
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $transaction->fresh();

        $response
            ->assertSee($transaction->latitude)
            ->assertSee($transaction->longitude);

        $this->assertDatabaseHas('transactions', [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    public function test_it_must_throw_error_when_service_return_error_message(): void
    {
        $message = $this->faker->text();
        Http::fake(function () use ($message) {
            return [
                'error' => [
                    'info' => $message,
                ],
            ];
        });
        $transaction = Transaction::factory()->create([
            'latitude' => null,
            'longitude' => null,
        ]);

        $response = $this->actingAs($this->allowedUser(self::TRANSACTION_PERMISSION))
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $transaction->fresh();

        $this->assertDatabaseHas('transactions', [
            'latitude' => null,
            'longitude' => null,
        ]);
    }
}
