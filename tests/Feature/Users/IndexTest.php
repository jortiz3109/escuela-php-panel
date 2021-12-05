<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    private const USERS_ROUTE_NAME = 'users.index';

    public function test_it_can_list_users(): void
    {
        $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME))
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_users(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME));

        $response->assertViewHas('users');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['users']);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $this->get(route(self::USERS_ROUTE_NAME))
            ->assertRedirect(route('login'));
    }

    public function test_collection_has_users(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME));
        $this->assertInstanceOf(User::class, $response->getOriginalContent()['users']->first());
    }

    public function test_it_show_users_data(): void
    {
        $user = $this->defaultUser();
        $response = $this->actingAs($user)->get(route(self::USERS_ROUTE_NAME));
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    /**
     * @dataProvider userProvider
     */
    public function test_it_can_filter_users(array $data): void
    {
        $this->withoutExceptionHandling();
        User::factory()->count(2)->create();
        User::factory()->create($data);
        $filters = http_build_query(['filters' => ['email' => 'rcjimenez35@gmail.com', 'created_at' => '2021-11-12',
            'enabled_at'=> false, ]]);
        $response = $this->actingAs(User::factory()->create())->get('/users?' . $filters);
        $users = $response->getOriginalContent()['users'];

        $this->assertEquals(1, $users->count());
        $this->assertEquals($data['created_at'], date('d-m-Y', strtotime($users->first()->created_at)));
        $this->assertEquals($data['enabled_at'], $users->first()->enabled_at);
        $this->assertEquals($data['email'], $users->first()->email);
    }

    public function test_it_can_filter_by_status_disabled(): void
    {
        User::factory()->disabled()->create();

        $response = $this->actingAs(User::factory()->create())->get('/users?' . http_build_query(['filters' => ['status' =>  'disabled']]));
        $users = $response->getOriginalContent()['users'];
        $this->assertEquals(false, $users->last()->enabled_at);
    }

    public function test_it_can_filter_by_status_enabled(): void
    {
        User::factory()->enabled()->create();

        $response = $this->actingAs(User::factory()->create())->get('/users?' . http_build_query(['filters' => ['enabled_at' =>   'true']]));
        $users = $response->getOriginalContent()['users'];

        $this->assertInstanceOf(Carbon::class, $users->first()->enabled_at);
    }

    public function userProvider(): array
    {
        return [
            [
                'data' => [
                    'name' => 'Roberto Jimenez',
                    'email' => 'rcjimenez35@gmail.com',
                    'enabled_at' => null,
                    'created_at'=> '12-11-2021',
                ],
            ],
        ];
    }

    public function filtersProvider(): array
    {
        return [
            ['data' => ['attribute' => 'name', 'filterValue' => 'Roberto Jimenez']],
            ['data' => ['attribute' => 'email', 'filterValue' => 'rcjimenez35@gmail.com']],
        ];
    }
}
