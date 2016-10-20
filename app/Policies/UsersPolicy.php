<?php

namespace App\Policies;

use App\User;
use App\Users;
use App\Policies\XtpPolicy;


class UsersPolicy extends XtpPolicy
{
    public function enter(User $user, Users $ability)
    {
        return $user->hasPermission('t_xtp_custom_teller');
    }
}
