<?php

namespace Database\Seeders;

use App\Constants\PermissionType;
use App\Models\Merchant;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    protected const PERMISSIONS_DATA = [
        [
            'name' => Merchant::PERMISSIONS[PermissionType::INDEX],
            'description' => 'Can list all merchants',
        ],
        [
            'name' => Merchant::PERMISSIONS[PermissionType::SHOW],
            'description' => 'Can show a merchant',
        ],
        [
            'name' => Merchant::PERMISSIONS[PermissionType::CREATE],
            'description' => 'Can create a merchant',
        ],
        [
            'name' => Merchant::PERMISSIONS[PermissionType::UPDATE],
            'description' => 'Can update a merchant',
        ],
        [
            'name' => Transaction::PERMISSIONS[PermissionType::INDEX],
            'description' => 'Can list all transactions',
        ],
        [
            'name' => Transaction::PERMISSIONS[PermissionType::SHOW],
            'description' => 'Can show a transaction',
        ],
    ];

    public function run()
    {
        DB::table('permissions')->insert(array_map(function ($permissionData) {
            $permissionData['created_at'] = now();
            $permissionData['updated_at'] = now();

            return $permissionData;
        }, self::PERMISSIONS_DATA));
    }
}
