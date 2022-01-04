<?php

namespace Tests\Feature\Concerns;

use App\Models\Permission;

trait HasDefaultPermission
{
    public function defaultPermission(): Permission
    {
        return Permission::factory()->create(
            [
                'name' => 'permissions.index',
                'description' => 'Can list system permissions',
            ]
        );
    }
}
