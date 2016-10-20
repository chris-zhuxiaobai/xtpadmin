<?php

namespace App\Policies;

use App\User;
use App\UserTradeWays;
use App\Policies\XtpPolicy;


class UsertradewaysPolicy extends XtpPolicy
{
    public function enter(User $user, UserTradeWays $userTradeWays)
    {
        return $user->hasPermission('t_xtp_server_admin');
    }
}
