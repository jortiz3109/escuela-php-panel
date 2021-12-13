<?php

namespace App\PropsViews\Constants;

use App\PropsViews\DateView;
use App\PropsViews\EnabledView;
use App\PropsViews\ImageView;
use App\PropsViews\TextView;

class PropViewTypes
{
    public const TEXT = 'text';
    public const DATE = 'date';
    public const IMAGE = 'image';
    public const ENABLED = 'enabled';

    public static function getTypeClasses(): array
    {
        return [
            self::TEXT => TextView::class,
            self::DATE => DateView::class,
            self::IMAGE => ImageView::class,
            self::ENABLED => EnabledView::class,
        ];
    }
}
