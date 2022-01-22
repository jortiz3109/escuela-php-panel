<?php

namespace Tests\Feature\Users;

use App\Constants\PermissionType;
use App\Http\Resources\Users\UsersIndexResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\UserIndexDataProvider;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use UserIndexDataProvider;
    use HasAuthenticatedUser;

    private const USERS_PERMISSION = PermissionType::USER_INDEX;

    /**
     * @test
     */
    public function a_guest_user_cannot_access(): void
    {
        $this->get(User::urlPresenter()->index())
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function an_user_without_permission_cannot_list_users(): void
    {
        $this->actingAs($this->defaultUser())
            ->get(User::urlPresenter()->index())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function it_can_list_users(): void
    {
        $this->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->index())
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_has_a_collection_of_users(): void
    {
        $response = $this->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->index());

        $response->assertViewHas('collection');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['collection']->resource);
    }

    /**
     * @test
     */
    public function collection_has_users(): void
    {
        $response = $this->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->index());

        $this->assertInstanceOf(UsersIndexResource::class, $response->getOriginalContent()['collection']->first());
    }

    /**
     * @test
     */
    public function it_show_users_data(): void
    {
        $response = $this->actingAs($user = $this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->index());

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
        User::factory()->count(2)->create();
        User::factory()->create($userData);

        $filters = http_build_query(['filters' => $filters]);
        $response = $this->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->index($filters));

        $users = $response->getOriginalContent()['collection'];

        $this->assertCount(1, $users);
        $this->assertEquals($userData['created_at'], date('d-m-Y', strtotime($users->first()->created_at)));
        $this->assertEquals($userData['enabled_at'], $users->first()->enabled_at);
        $this->assertEquals($userData['email'], $users->first()->email);
    }

    /**
     * @dataProvider hasFilteredStatusDataProvider
     *
     * @param int $enabled
     * @param int $disabled
     * @param string $filterBy
     * @param int $filtered
     *
     * @test
     */
    public function it_can_filter_by_status(int $enabled, int $disabled, string $filterBy, int $filtered): void
    {
        User::factory()->count($enabled)->enabled()->create();
        User::factory()->count($disabled)->disabled()->create();

        $filters = http_build_query(['filters' => ['status' =>  $filterBy]]);
        $response = $this->actingAs($this->allowedUser(self::USERS_PERMISSION))
            ->get(User::urlPresenter()->index($filters));

        $users = $response->getOriginalContent()['collection'];

        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount($filtered, $users);
    }
}
