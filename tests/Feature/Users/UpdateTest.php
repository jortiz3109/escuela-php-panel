<?php

namespace Tests\Feature\Users;

use App\Constants\PermissionType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use HasAuthenticatedUser;
    use RefreshDatabase;

    private const USERS_PERMISSION = PermissionType::USER_UPDATE;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'John',
            'email' => 'test@email.com',
        ]);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->put(User::urlPresenter()->update($this->user), $this->userData());
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $this->actingAs($this->defaultUser())
            ->put(User::urlPresenter()->update($this->user), $this->userData())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_update_user(): void
    {
        $this
            ->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->put(User::urlPresenter()->update($this->user), $this->userData());

        $this->user->refresh();

        $this->assertEquals($this->userData()['name'], $this->user->name);
        $this->assertEquals($this->userData()['email'], $this->user->email);
    }

    /**
     * @param string $field
     * @param array $data
     * @return void
     * @dataProvider userDataProvider
     */
    public function test_it_cannot_update_user_with_invalid_data(string $field, array $data): void
    {
        $response = $this
            ->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->put(User::urlPresenter()->update($this->user), $data);

        $response->assertSessionHasErrors($field);
    }

    public function test_it_cannot_update_user_with_repeated_email(): void
    {
        $fakeUser = User::factory()->create();

        $response = $this
            ->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->put(User::urlPresenter()->update($this->user), ['email' => $fakeUser->email]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_an_user_loses_their_email_verification_when_updating_it(): void
    {
        $this
            ->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->put(User::urlPresenter()->update($this->user), $this->userData());

        $this->user->refresh();

        $this->assertNull($this->user['email_verified_at']);
    }

    public function userDataProvider(): array
    {
        return [
            'name is required' => ['field' => 'name', 'data' => array_merge($this->userData(), ['name' => null])],
            'name has not numbers' => ['field' => 'name', 'data' => array_merge($this->userData(), ['name' => 'test1'])],
            'name is greater than 2 chars' => ['field' => 'name', 'data' => array_merge($this->userData(), ['name' => 't'])],
            'name is less than 255 chars' => ['field' => 'name', 'data' => array_merge($this->userData(), ['name' => Str::random(256)])],

            'email is required' => ['field' => 'email', 'data' => array_merge($this->userData(), ['email' => null])],
            'email is email' => ['field' => 'email', 'data' => array_merge($this->userData(), ['email' => 'notEmail'])],
            'email is greater than 2 chars' => ['field' => 'email', 'data' => array_merge($this->userData(), ['email' => 't'])],
            'email is less than 255 chars' => ['field' => 'email', 'data' => array_merge($this->userData(), ['email' => Str::random(256)])],
        ];
    }

    public function userData(): array
    {
        return [
            'name' => 'new name',
            'email' => 'new@email.com',
        ];
    }
}
