<?php

namespace Tests\Unit\Filters\ModelFilters;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PermissionFiltersTest extends TestCase
{
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
