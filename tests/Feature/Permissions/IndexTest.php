<?php

namespace Tests\Feature\Permissions;

use App\Constants\PermissionType;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\PermissionHasDataProvider;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use PermissionHasDataProvider;

    public const PERMISSIONS_ROUTE_NAME = 'permissions.index';
    private const PERMISSIONS_PERMISSION = PermissionType::PERMISSION_INDEX;

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::PERMISSIONS_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_list_permissions(): void
    {
        $response = $this->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))->get(route(self::PERMISSIONS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_permissions(): void
    {
        $response = $this->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))->get(route(self::PERMISSIONS_ROUTE_NAME));
        $response->assertViewHas('collection');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['collection']);
    }

    public function test_collection_has_permissions(): void
    {
        Permission::factory()->create();
        $response = $this->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))->get(route(self::PERMISSIONS_ROUTE_NAME));
        $this->assertInstanceOf(Permission::class, $response->getOriginalContent()['collection']->first());
    }

    public function test_it_show_permissions_data(): void
    {
        $data = $this->validPermissionData();
        $permission = Permission::factory()->create($data);
        $filters = http_build_query(['filters' => ['name' => $data['name']]]);

        $response = $this->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))
            ->get(route(self::PERMISSIONS_ROUTE_NAME, $filters));

        $response->assertSee($permission->name);
        $response->assertSee($permission->description);
    }

    /**
     * @dataProvider validationFilterProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))->get(route(self::PERMISSIONS_ROUTE_NAME, $filters));

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    public function test_it_can_filter_permissions(): void
    {
        Permission::factory()->count(3)->create();
        Permission::factory()->create($this->validPermissionData());

        $filters = http_build_query(['filters' => ['name' => 'valid.']]);
        $response = $this->actingAs($this->allowedUser(self::PERMISSIONS_PERMISSION))->get(route(self::PERMISSIONS_ROUTE_NAME, $filters));
        $permissions = $response->getOriginalContent()['collection'];

        $this->assertEquals(1, $permissions->count());
        $this->assertEquals('valid.name', $permissions->first()->name);
    }
}
