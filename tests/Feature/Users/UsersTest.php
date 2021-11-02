<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_return_response(): void
    {
        $response = $this->get('/users');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get('/users');
        $response->assertRedirect(route('login'));
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

    public function filtersProvider(): array
    {
        return [
            'find by email' => ['filters' => ['email' => 'rcjimenez35@gmail.com']],
            'find by name' => ['filters' => ['name' => 'Roberto Jimenez']],
            'find by enabled_at' => ['filters' => ['enabled_at' => now()->subMonth()->toDateString()]],
        ];
    }

    public function enabledAtProvider(): array
    {
        return [
            'user is enabled' => ['enabled_at' => now()->subMonth()->toDateString()],
            'user is not enabled' => ['enabled_at' => null],
        ];
    }
}
