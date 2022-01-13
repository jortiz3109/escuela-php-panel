<?php

namespace Tests\Feature\Permissions;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\PermissionHasDataProvider;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use PermissionHasDataProvider;

    public const PERMISSIONS_ROUTE_NAME = 'permissions.update';
    private Model $permission;
    private array $newData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = Permission::factory()->create([
            'name' => 'My permission',
            'description' => 'My description',
        ]);

        $this->newData = [
            'description' => 'New description',
        ];
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->put(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id), $this->newData);
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_update_permission(): void
    {
        $this
            ->actingAs($this->defaultUser())
            ->put(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id), $this->newData);

        $this->permission->refresh();

        $this->assertEquals($this->newData['description'], $this->permission->description);
    }

    public function test_it_alerts_a_permission_update(): void
    {
        $response = $this
            ->actingAs($this->defaultUser())
            ->put(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id), $this->newData);

        $response->assertRedirect(route('permissions.index'));
        $response->assertSessionHas('success', trans('permissions.alerts.successful_update'));
    }

    /**
     * @dataProvider validationFieldsProvider
     */
    public function test_it_validates_fields(string $field, array $data): void
    {
        $response = $this
            ->actingAs($this->defaultUser())
            ->put(route(self::PERMISSIONS_ROUTE_NAME, $this->permission->id), $data);

        $response->assertSessionHasErrors($field);
    }
}
