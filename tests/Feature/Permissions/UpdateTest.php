<?php

namespace Tests\Feature\Permissions;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

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
            'name' => 'New name',
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

        $this->assertEquals($this->newData['name'], $this->permission->name);
        $this->assertEquals($this->newData['description'], $this->permission->description);
    }
}
