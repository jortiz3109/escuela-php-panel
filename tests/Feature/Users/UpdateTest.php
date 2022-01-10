<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use HasAuthenticatedUser;
    use RefreshDatabase;

    public const USERS_ROUTE_NAME = 'users.update';
    private User $user;
    private array $newData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'John',
            'email' => 'test@email.com',
        ]);

        $this->newData = [
            'name' => 'new name',
            'email' => 'new@email.com',
        ];
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->put(route(self::USERS_ROUTE_NAME, $this->user->id, $this->newData));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_update_user(): void
    {
        $this
            ->actingAs($this->defaultUser())
            ->put(route(self::USERS_ROUTE_NAME, $this->user->id), $this->newData);

        $this->user->refresh();

        $this->assertEquals($this->newData['name'], $this->user->name);
        $this->assertEquals($this->newData['email'], $this->user->email);
    }

    public function test_it_can_see_user_data(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME, $this->user->id));
        $response->assertSee($this->user->name);
        $response->assertSee($this->user->email);
    }
}
