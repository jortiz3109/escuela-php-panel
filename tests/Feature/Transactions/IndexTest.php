<?php

namespace Tests\Feature\Transactions;

use App\Constants\TransactionStatus;
use App\Http\Resources\Transactions\IndexResource;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
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

    public function test_it_show_transactions_data(): void
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

    public function test_it_can_filter_transactions_by_status()
    {
        Transaction::factory(5)->create(['status' => TransactionStatus::STATUS_FAILED]);
        $approvedTransaction = Transaction::factory()->create(['status' => TransactionStatus::STATUS_APPROVED]);

        $filters = http_build_query(['filters' => ['status' => TransactionStatus::STATUS_APPROVED]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME, $filters));
        $transactions = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $transactions);
        $this->assertEquals(TransactionStatus::STATUS_APPROVED, $transactions->first()->status);
    }

    public function test_it_can_filter_transactions_by_merchant()
    {
        Transaction::factory(5)->create();
        $transaction = Transaction::factory()->create();

        $filters = http_build_query(['filters' => ['merchant' => $transaction->merchant->name]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME, $filters));
        $transactions = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $transactions);
        $this->assertEquals($transaction->merchant->name, $transactions->first()->merchant);
    }

    public function test_it_can_filter_transactions_by_reference()
    {
        Transaction::factory(5)->create();
        Transaction::factory()->create(['reference' => '123456']);

        $filters = http_build_query(['filters' => ['reference' => '123456']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME, $filters));
        $transactions = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $transactions);
        $this->assertEquals('123456', $transactions->first()->reference);
    }

    public function test_it_can_filter_transactions_by_payment_method()
    {
        $paymentMethod = new PaymentMethod();
        $paymentMethod->name = 'new payment method';
        $paymentMethod->logo = 'my logo';
        $paymentMethod->save();

        Transaction::factory(5)->create();
        Transaction::factory()->create(['payment_method_id' => $paymentMethod->id]);

        $filters = http_build_query(['filters' => ['payment_method' => $paymentMethod->name]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME, $filters));
        $transactions = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $transactions);
        $this->assertEquals('new payment method', $transactions->first()->payment_method);
    }

    public function test_it_can_filter_transactions_by_date()
    {
        Transaction::factory(5)->create();
        Transaction::factory()->create(['executed_at' => Carbon::parse('2021-11-29')]);

        $filters = http_build_query(['filters' => ['date' => '11/29/2021 - 11/29/2021']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME, $filters));
        $transactions = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $transactions);
        $this->assertEquals('2021-11-29', $transactions->first()->executed_at->toDateString());
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::TRANSACTIONS_ROUTE_NAME, $filters));

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    public function validationProvider(): array
    {
        return [
            'merchant min' => ['attribute' => 'merchant', 'value' => 'a'],
            'merchant max' => ['attribute' => 'merchant', 'value' => Str::random(121)],
            'reference min' => ['attribute' => 'reference', 'value' => '1'],
            'reference max' => ['attribute' => 'reference', 'value' => Str::random(121)],
        ];
    }
}
