<?php

namespace Tests\Feature\Transactions;

use App\Http\Resources\Transactions\IndexResource;
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
}
