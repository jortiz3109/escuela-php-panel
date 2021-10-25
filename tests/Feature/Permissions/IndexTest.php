<?php

namespace Tests\Feature\Permissions;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get('/permissions');
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_list_permissions(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/permissions');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_permissions(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/permissions');
        $response->assertViewHas('permissions');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['permissions']);
    }

    public function test_collection_has_permissions(): void
    {
        Permission::factory()->create();
        $response = $this->actingAs(User::factory()->create())->get('/permissions');
        $this->assertInstanceOf(Permission::class, $response->getOriginalContent()['permissions']->first());
    }

    /**
     * @param array $data
     * @dataProvider permissionProvider
     */
    public function test_it_show_permissions_data(array $data): void
    {
        $permission = Permission::factory()->create($data);
        $response = $this->actingAs(User::factory()->create())->get('/permissions');
        $response->assertSee($permission->name);
        $response->assertSee($permission->description);
    }

    /**
     * @dataProvider validationProvider
     */
    public function test_it_validates_filters(string $attribute, $value): void
    {
        $filters = http_build_query(['filters' => [$attribute => $value]]);
        $response = $this->actingAs(User::factory()->create())->get('/permissions?' . $filters);

        $response->assertSessionHasErrors("filters.{$attribute}");
    }

    /**
     * @param array $data
     * @dataProvider permissionProvider
     */
    public function test_it_can_filter_permissions(array $data): void
    {
        Permission::factory()->count(3)->create();
        Permission::factory()->create($data);

        $filters = http_build_query(['filters' => ['name' => 'permissions.']]);
        $response = $this->actingAs(User::factory()->create())->get('/permissions?' . $filters);
        $permissions = $response->getOriginalContent()['permissions'];

        $this->assertEquals(1, $permissions->count());
        $this->assertEquals($data['name'], $permissions->first()->name);
    }

    public function validationProvider(): array
    {
        return [
            'name min' => ['attribute' => 'name', 'value' => 'f'],
            'name max' => ['attribute' => 'name', 'value' => Str::random(126)],
        ];
    }

    public function permissionProvider(): array
    {
        return [
            ['data' => ['name' => 'permissions.index', 'description' => 'Can list system permissions']],
        ];
    }
}
