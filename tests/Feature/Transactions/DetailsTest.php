<?php

namespace Tests\Feature\Transactions;

use App\Models\Person;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class DetailsTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public const TRANSACTION_DETAILS_ROUTE_NAME = 'transactions.show';

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, 1));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_render_the_transaction_details_page(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($this->defaultUser())
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_transaction_model(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($this->defaultUser())
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertViewHas('transaction');

        $this->assertInstanceOf(Transaction::class, $response->getOriginalContent()['transaction']);
    }

    public function test_it_can_show_the_transaction_info(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($this->defaultUser())
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertSee($transaction->merchant->name)
            ->assertSee($transaction->reference)
            ->assertSee($transaction->paymentMethod->logo)
            ->assertSee($transaction->card_number)
            ->assertSee($transaction->currency->name)
            ->assertSee($transaction->currency->alphabetic_code)
            ->assertSee($transaction->currency->symbol)
            ->assertSee($transaction->status)
            ->assertSee($transaction->ip_address);
    }

    public function test_it_show_the_payer_info(): void
    {
        $transaction = Transaction::factory()
            ->for(Person::factory()->create([
                'name' => 'payer-name',
                'email' => 'payer@example.com',
            ]), 'payer')
            ->create();

        $response = $this->actingAs($this->defaultUser())
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

        $response = $this->actingAs($this->defaultUser())
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertSee('buyer-name');
        $response->assertSee('buyer@example.com');
    }
}
