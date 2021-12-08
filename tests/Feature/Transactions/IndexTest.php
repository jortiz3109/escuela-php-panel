<?php

namespace Tests\Feature\Transactions;

use App\Http\Resources\Transactions\IndexResource;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public const TRANSACTIONS_ROUTE_NAME = 'transactions.index';

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::TRANSACTIONS_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_list_transactions(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_transactions(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME));

        $response->assertViewHas('collection');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['collection']->resource);
        $this->assertEquals(IndexResource::class, $response->getOriginalContent()['collection']->collects);
    }

    public function test_collection_has_transactions(): void
    {
        Transaction::factory()->create();
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME));
        $this->assertInstanceOf(Transaction::class, $response->getOriginalContent()['collection']->first()->resource);
    }

    public function test_it_show_permissions_data(): void
    {
        $transaction = Transaction::factory()->create();
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME));

        $response->assertSee($transaction->executed_at->toDateString());
        $response->assertSee($transaction->merchant->name);
        $response->assertSee($transaction->currency->alphabetic_code);
        $response->assertSee($transaction->total_amount);
        $response->assertSee($transaction->payment_method);
        $response->assertSee($transaction->status);
    }
}
