<?php

namespace App\Policies;

use App\User;
use App\Api;
use App\Policies\XtpPolicy;


class ApiPolicy extends XtpPolicy
{
    public function enter(User $user, Api $api)
    {
        return false;
    }
}
