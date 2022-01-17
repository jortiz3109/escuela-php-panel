<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\UserStoreDataProvider;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use UserStoreDataProvider;
    use HasAuthenticatedUser;

    public function test_it_can_create_a_user(): void
    {
        $data = $this->userData();
        $this->actingAs($this->defaultUser())->post('/users', $data)
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'created_by' => auth()->id(),
        ]);
    }

    /**
     * @dataProvider invalidUserData
     * @param string $field
     * @param array  $data
     */
    public function test_it_can_not_create_a_user_with_invalid_data(string $field, array $data): void
    {
        $this->actingAs($this->defaultUser())
            ->post('/users', $data)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertInvalid([$field]);

        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function test_a_user_is_created_with_disabled_status_by_default(): void
    {
        $this->actingAs($this->defaultUser())->post('/users', $this->userData())
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name' => $this->userData()['name'],
            'enabled_at' => null,
        ]);
    }

    public function test_it_has_a_created_by_id_with_authenticated_user_id(): void
    {
        $this->actingAs($user = $this->defaultUser())
            ->post(route('users.store'), $this->userData())
            ->assertRedirect(route('users.index'));

        $this->assertEquals($user->id, User::latest('id')->first()->created_by);
    }
}
