<?php

namespace Tests\Feature\Permissions;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\Feature\Concerns\HasDefaultPermission;
use Tests\Feature\Concerns\HasNamesValidationProvider;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use HasDefaultPermission;
    use HasNamesValidationProvider;

    public const PERMISSIONS_ROUTE_NAME = 'permissions.index';

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::PERMISSIONS_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_list_permissions(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_permissions(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME));
        $response->assertViewHas('permissions');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['permissions']);
    }

    public function test_collection_has_permissions(): void
    {
        Permission::factory()->create();
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME));
        $this->assertInstanceOf(Permission::class, $response->getOriginalContent()['permissions']->first());
    }

    public function test_it_show_permissions_data(): void
    {
        $permission = $this->defaultPermission();
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME));
        $response->assertSee($permission->name);
        $response->assertSee($permission->description);
    }

    /**
     * @dataProvider namesValidationProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME, $filters));

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    public function test_it_can_filter_permissions(): void
    {
        Permission::factory()->count(3)->create();
        $permission = $this->defaultPermission();

        $filters = http_build_query(['filters' => ['name' => 'permissions.']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME, $filters));
        $permissions = $response->getOriginalContent()['permissions'];

        $this->assertEquals(1, $permissions->count());
        $this->assertEquals($permission->name, $permissions->first()->name);
    }
}
