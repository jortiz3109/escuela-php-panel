<?php

namespace Tests\Feature\PaymentMethods;

use App\Http\Resources\PaymentMethods\PaymentMethodIndexResource;
use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    private const PAYMENT_METHODS_ROUTE_NAME = 'payment_methods.index';

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::PAYMENT_METHODS_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_list_payment_methods(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::PAYMENT_METHODS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_payment_methods(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::PAYMENT_METHODS_ROUTE_NAME));

        $response->assertViewHas('collection');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['collection']->resource);
        $this->assertEquals(PaymentMethodIndexResource::class, $response->getOriginalContent()['collection']->collects);
    }

    public function test_it_show_payment_methods_data(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();

        $response = $this->actingAs($this->defaultUser())->get(route(self::PAYMENT_METHODS_ROUTE_NAME));
        $response
            ->assertSee($paymentMethod->name)
            ->assertSee($paymentMethod->logo)
            ->assertSee($paymentMethod->enabled_at);
    }

    /**
     * @param string $filter
     * @param string $attribute
     * @param string $filterValue
     * @param string $showedValue
     * @dataProvider filtersProvider
     */
    public function test_it_can_filter_payment_method(
        string $filter,
        string $attribute,
        string $filterValue,
        string $showedValue
    ): void {
        PaymentMethod::factory()->count(5)->create();
        PaymentMethod::factory()->create([
            $attribute => $showedValue,
        ]);

        $filters = http_build_query(['filters' => [$filter => $filterValue]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::PAYMENT_METHODS_ROUTE_NAME, $filters));
        $paymentMethods = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $paymentMethods);
        $response->assertSee($attribute === 'name' ? $showedValue : $filterValue);
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::PAYMENT_METHODS_ROUTE_NAME, $filters));

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    public function filtersProvider(): array
    {
        return [
            'By name' => [
                'filter' => 'name',
                'attribute' => 'name',
                'filterValue' => 'VISA TEST',
                'showedValue' => 'VISA TEST',
            ],
            'By status' => [
                'filter' => 'status_enabled',
                'attribute' => 'enabled_at',
                'filterValue' => 'enabled',
                'showedValue' => '2021-01-01',
            ],
        ];
    }

    public function validationProvider(): array
    {
        return [
            'name short' => [
                'attribute' => 'name',
                'value' => 'a',
            ],
            'enabled_at not string' => [
                'attribute' => 'status_enabled',
                'value' => 12345,
            ],
            'enabled_at not in enabled, disabled' => [
                'attribute' => 'status_enabled',
                'value' => 'enabled_test',
            ],
        ];
    }
}
