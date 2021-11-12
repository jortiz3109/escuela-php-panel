<?php

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DetailsTest extends TestCase
{
    use RefreshDatabase;

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
        $transaction = Transaction::factory()->create([
            'payer' => json_encode([
                'name' => 'payer-name',
                'email' => 'payer@example.com',
            ])
        ]);

        $response = $this->actingAs($this->defaultUser())
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertViewHas('payer');

        $response->assertViewHas('payer', function ($payer) {
            return $payer->name === 'payer-name';
        });

        $response->assertViewHas('payer', function ($payer) {
            return $payer->email === 'payer@example.com';
        });
    }

    public function test_it_show_the_buyer_info(): void
    {
        $transaction = Transaction::factory()->create([
            'buyer' => json_encode([
                'name' => 'buyer-name',
                'email' => 'buyer@example.com',
            ])
        ]);

        $response = $this->actingAs($this->defaultUser())
            ->get(route(self::TRANSACTION_DETAILS_ROUTE_NAME, $transaction));

        $response->assertViewHas('buyer');

        $response->assertViewHas('buyer', function ($buyer) {
            return $buyer->name === 'buyer-name';
        });

        $response->assertViewHas('buyer', function ($buyer) {
            return $buyer->email === 'buyer@example.com';
        });
    }
}
