<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_can_list_permissions(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/users');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_users(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/users');
        $response->assertViewHas('users');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['users']);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get('/users');
        $response->assertRedirect(route('login'));
    }

    public function test_collection_has_users(): void
    {
        User::factory()->create();
        $response = $this->actingAs(User::factory()->create())->get('/users');
        $this->assertInstanceOf(User::class, $response->getOriginalContent()['users']->first());
    }

    public function test_it_can_list_users(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/users');
        $response->assertStatus(Response::HTTP_OK);
    }
    /**
     * @param array $data
     * @dataProvider userProvider
     */
    public function test_it_show_users_data(array $data): void
    {
        $user = User::factory()->create($data);
        $response = $this->actingAs(User::factory()->create())->get('/users');
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    /**
     * @dataProvider userProvider
     */
    public function test_it_can_filter_users(array $data): void
    {
        User::factory()->count(3)->create();
        User::factory()->create($data);
        $filters = http_build_query(['filters' => ['email' => 'rcjimenez35@gmail.com']]);
        $response = $this->actingAs(User::factory()->create())->get('/users?' . $filters);
        $users = $response->getOriginalContent()['users'];
        $this->assertEquals(1, $users->count());
        $this->assertEquals($data['email'], $users->first()->email);
    }

    public function userProvider(): array
    {
        return [
            ['data' => ['name' => 'Roberto Jimenez', 'email' => 'rcjimenez35@gmail.com', 'enabled_at' => now()->subMonth()->toDateString()]],
        ];
    }
}
