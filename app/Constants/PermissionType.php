<?php

namespace App\Constants;

class PermissionType
{
    public const COUNTRY_INDEX = 'country.index';

    public const CURRENCY_INDEX = 'currency.index';

    public const MERCHANT_INDEX = 'merchant.index';
    public const MERCHANT_SHOW = 'merchant.show';
    public const MERCHANT_CREATE = 'merchant.create';
    public const MERCHANT_UPDATE = 'merchant.update';

    public const PAYMENT_METHOD_INDEX = 'payment-method.index';

    public const PERMISSION_INDEX = 'permission.index';
    public const PERMISSION_UPDATE = 'permission.update';

    public const USER_INDEX = 'user.index';
    public const USER_UPDATE = 'user.update';

    public const TRANSACTION_INDEX = 'transaction.index';
    public const TRANSACTION_SHOW = 'transaction.show';
}
