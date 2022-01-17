<?php

namespace Tests\Feature\Permissions;

use App\Constants\PermissionType;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class EditTest extends TestCase
{
    use HasAuthenticatedUser;
    use RefreshDatabase;

    public const PERMISSIONS_ROUTE_NAME = 'permissions.edit';
    private const PERMISSIONS_PERMISSION = PermissionType::PERMISSION_UPDATE;
    private Model $permission;

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = Permission::factory()->create();
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id));
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $response = $this
            ->actingAs($this->defaultUser())
            ->get(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_edit_permission(): void
    {
        $response = $this
            ->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))
            ->get(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_see_permission_edition_view(): void
    {
        $response = $this
            ->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))
            ->get(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id));

        $response->assertViewIs('modules.edit');
    }

    public function test_it_can_see_permission_data(): void
    {
        $response = $this->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))->get(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id));
        $response->assertSee($this->permission->name);
        $response->assertSee($this->permission->description);
    }
}
