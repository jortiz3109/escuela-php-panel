<?php

namespace App\View\Composers\users;

use App\Constants\UserStatus;
use Illuminate\View\View;

class UserStatusComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'statuses',
            UserStatus::STATUSES,
        );
    }
}
