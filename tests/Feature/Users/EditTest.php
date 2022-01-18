<?php

namespace Tests\Feature\Users;

use App\Constants\PermissionType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class EditTest extends TestCase
{
    use HasAuthenticatedUser;
    use RefreshDatabase;

    private const USERS_PERMISSION = PermissionType::USER_UPDATE;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(User::urlPresenter()->edit($this->user));
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $response = $this
            ->actingAs($this->defaultUser())
            ->get(User::urlPresenter()->edit($this->user));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_edit_user(): void
    {
        $response = $this
            ->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->edit($this->user));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_see_users_edition_view(): void
    {
        $response = $this
            ->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->edit($this->user));

        $response->assertViewIs('modules.edit');
    }

    public function test_it_can_see_user_data(): void
    {
        $response = $this
            ->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->edit($this->user));

        $response->assertSee($this->user->name);
        $response->assertSee($this->user->email);
    }
}
