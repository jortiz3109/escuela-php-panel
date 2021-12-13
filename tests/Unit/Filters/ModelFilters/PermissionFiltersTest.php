<?php

namespace Tests\Unit\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\ModelFilters\PermissionFilters;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use ReflectionException;
use Tests\TestCase;

class PermissionFiltersTest extends TestCase
{
    private string $modelInstance = Permission::class;

    /**
     * @throws ReflectionException
     */
    public function test_model_instance(): void
    {
        $this->assertSame(
            $this->modelInstance,
            $this->getReflectionProtectedPropertyValue(PermissionFilters::class, 'model')
        );
    }

    /**
     * @throws ReflectionException
     */
    public function test_applicable_conditions(): void
    {
        $expected = [
            'name' => Name::class,
        ];

        $this->assertSame(
            $expected,
            $this->getReflectionProtectedPropertyValue(PermissionFilters::class, 'applicableConditions')
        );
    }

    public function test_query_without_params(): void
    {
        $expected = DB::table('permissions')
            ->select(['name', 'description', 'created_at'])
            ->toSql();

        $this->assertEquals($expected, Permission::filter([])->toSql());
    }

    public function test_query_with_params(): void
    {
        $expected = DB::table('permissions')
            ->select(['name', 'description', 'created_at'])
            ->where('name', 'like', '%Barry%')
            ->toSql();

        $this->assertEquals($expected, Permission::filter(['name' => 'Barry'])->toSql());
    }
}
