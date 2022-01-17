<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class EditTest extends TestCase
{
    use HasAuthenticatedUser;
    use RefreshDatabase;

    public const USERS_ROUTE_NAME = 'users.edit';
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::USERS_ROUTE_NAME, $this->user->id));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_edit_user(): void
    {
        $response = $this
            ->actingAs($this->defaultUser())
            ->get(route(self::USERS_ROUTE_NAME, $this->user->id));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_see_users_edition_view(): void
    {
        $response = $this
            ->actingAs($this->defaultUser())
            ->get(route(self::USERS_ROUTE_NAME, $this->user->id));

        $response->assertViewIs('modules.edit');
    }

    public function test_it_can_see_user_data(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME, $this->user->id));
        $response->assertSee($this->user->name);
        $response->assertSee($this->user->email);
    }
}
