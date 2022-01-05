<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\Support\User\UserIndexDataProvider;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use UserIndexDataProvider;
    use HasAuthenticatedUser;

    private const USERS_ROUTE_NAME = 'users.index';
    private const FILTER_URI = '/users?';

    /**
     * @test
     */
    public function it_can_list_users(): void
    {
        $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME))
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_has_a_collection_of_users(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME));

        $response->assertViewHas('users');
        $this->assertInstanceOf(Paginator::class, $response->getOriginalContent()['users']);
    }

    /**
     * @test
     */
    public function a_guest_user_cannot_access(): void
    {
        $this->get(route(self::USERS_ROUTE_NAME))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function collection_has_users(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME));
        $this->assertInstanceOf(User::class, $response->getOriginalContent()['users']->first());
    }

    /**
     * @test
     */
    public function it_show_users_data(): void
    {
        $response = $this->actingAs($user = $this->defaultUser())->get(route(self::USERS_ROUTE_NAME));

        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    /**
     * @dataProvider userFilterDataProvider
     * @param array $filters
     * @param array $userData
     * @test
     */
    public function it_can_filter_users(array $filters, array $userData): void
    {
        $this->withoutExceptionHandling();
        User::factory()->count(2)->create();
        User::factory()->create($userData);
        $filters = http_build_query($filters);
        $response = $this->actingAs($this->defaultUser())->get(self::FILTER_URI . $filters);
        $users = $response->getOriginalContent()['users'];

        $this->assertCount(1, $users);
        $this->assertEquals($userData['created_at'], date('d-m-Y', strtotime($users->first()->created_at)));
        $this->assertEquals($userData['enabled_at'], $users->first()->enabled_at);
        $this->assertEquals($userData['email'], $users->first()->email);
    }

    /**
     * @dataProvider hasFilteredStatusDataProvider
     * @param array $enabled
     * @param array $disabled
     * @param string $filterBy
     * @param int $filtered
     * @test
     */
    public function it_can_filter_by_status(array $enabled, array $disabled, string $filterBy, int $filtered): void
    {
        User::factory()->count($enabled['count'])->{$enabled['status']}()->create();
        User::factory()->count($disabled['count'])->{$disabled['status']}()->create();

        $response = $this->actingAs($this->defaultUser())->get(self::FILTER_URI . http_build_query(['filters' => ['status' =>  $filterBy]]));
        $users = $response->getOriginalContent()['users'];

        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount($filtered, $users);
    }
}
