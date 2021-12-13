<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\Support\UserDataProvider;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;
    use UserDataProvider;

    /**
     * @test
     */
    public function authenticated_user_can_view_the_create_view(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/users/create')
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function unauthenticated_user_can_not_view_the_create_view(): void
    {
        $this->get('/users/create')
            ->assertStatus(Response::HTTP_FOUND);
    }

    /**
     * @dataProvider validUserData
     * @param array $data
     * @test
     */
    public function a_user_can_be_store(array $data): void
    {
        $user = User::factory()->create();

        $data['created_by'] = $user->id;
        $data['updated_by'] = $user->id;

        $this->actingAs($user)->post('/users', $data)
            ->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);
    }

    /**
     * @dataProvider invalidUserData
     * @param array $data
     * @param string $field
     * @test
     */
    public function a_user_store_required_data(array $data, string $field): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/users', $data)
            ->assertStatus(302)
            ->assertInvalid([$field]);

        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    /**
     * @dataProvider validUserStatusData
     * @param array $data
     * @param array $status
     * @test
     */
    public function disabled_user_register(array $data, array $status): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/users', $data)
            ->assertRedirect('dashboard');

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'enabled_at' =>$status['value'],
        ]);
    }

    /**
     * @dataProvider validUserData
     * @param array $data
     * @test
     */
    public function create_id_user_register(array $data): void
    {
        $user = User::factory()->create();

        $data['created_by'] = $user->id;
        $data['updated_by'] = $user->id;

        $this->actingAs($user)->post('/users', $data)
            ->assertRedirect('/dashboard');

        $this->assertEquals(User::latest('id')->first()->created_by, $user->id);
    }

    /**
     * @dataProvider validUserData
     * @param array $data
     * @test
     */
    public function unique_email_user_register(array $data): void
    {
        $user = User::factory()->create(['email' => $data['email']]);

        $this->actingAs($user)->post('/users', $data)
            ->assertInvalid(['email'])
            ->assertRedirect('/');

        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }
}
