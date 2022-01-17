<?php

namespace Database\Seeders;

use App\Constants\PermissionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    protected const PERMISSIONS_DATA = [
        [
            'name' => PermissionType::CURRENCY_INDEX,
            'description' => 'Can list all currencies',
        ],
        [
            'name' => PermissionType::COUNTRY_INDEX,
            'description' => 'Can list all countries',
        ],
        [
            'name' => PermissionType::MERCHANT_INDEX,
            'description' => 'Can list all merchants',
        ],
        [
            'name' => PermissionType::MERCHANT_SHOW,
            'description' => 'Can show a merchant',
        ],
        [
            'name' => PermissionType::MERCHANT_CREATE,
            'description' => 'Can create a merchant',
        ],
        [
            'name' => PermissionType::MERCHANT_UPDATE,
            'description' => 'Can update a merchant',
        ],
        [
            'name' => PermissionType::TRANSACTION_INDEX,
            'description' => 'Can list all transactions',
        ],
        [
            'name' => PermissionType::TRANSACTION_SHOW,
            'description' => 'Can show a transaction',
        ],
        [
            'name' => PermissionType::PAYMENT_METHOD_INDEX,
            'description' => 'Can list all payment methods',
        ],
        [
            'name' => PermissionType::PERMISSION_INDEX,
            'description' => 'Can list all permissions',
        ],
        [
            'name' => PermissionType::PERMISSION_UPDATE,
            'description' => 'Can update a permission',
        ],
        [
            'name' => PermissionType::USER_INDEX,
            'description' => 'Can list all users',
        ],
        [
            'name' => PermissionType::USER_UPDATE,
            'description' => 'Can update a user',
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
