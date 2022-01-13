<?php

namespace Tests\Feature\Permissions;

use App\Http\Resources\Permissions\PermissionIndexResource;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\PermissionHasDataProvider;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use PermissionHasDataProvider;

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
        $response->assertViewHas('collection');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['collection']->resource);
        $this->assertEquals(PermissionIndexResource::class, $response->getOriginalContent()['collection']->collects);
    }

    public function test_collection_has_permissions(): void
    {
        Permission::factory()->create();
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME));
        $this->assertInstanceOf(Permission::class, $response->getOriginalContent()['collection']->first()->resource);
    }

    public function test_it_show_permissions_data(): void
    {
        $data = $this->validPermissionData();
        $permission = Permission::factory()->create($data);
        $filters = http_build_query(['filters' => ['name' => $data['name']]]);

        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME, $filters));

        $response->assertSee($permission->name);
        $response->assertSee($permission->description);
    }

    /**
     * @dataProvider validationFilterProvider
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
        Permission::factory()->create($this->validPermissionData());

        $filters = http_build_query(['filters' => ['name' => 'valid.']]);
        $response = $this->actingAs($this->defaultUser())->get(route(self::PERMISSIONS_ROUTE_NAME, $filters));
        $permissions = $response->getOriginalContent()['collection'];

        $this->assertEquals(1, $permissions->count());
        $this->assertEquals('valid.name', $permissions->first()->name);
    }
}
